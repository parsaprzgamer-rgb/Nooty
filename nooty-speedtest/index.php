<?php
// index.php – NootySpeedTest (Open Source Edition)

// Load external AI configuration
require_once __DIR__ . '/config.php';

// Create data directory if not exists
$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) mkdir($dataDir, 0755, true);
$subFile = $dataDir . '/submissions.json';
$newsFile = $dataDir . '/news.json';

if (isset($_GET['action']) && $_GET['action'] === 'check' && !empty($_GET['domain'])) {
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    error_reporting(0);

    $domain = preg_replace('/^https?:\/\//', '', rtrim($_GET['domain'], '/'));

    function isIranianDomain($d) {
        $tlds = ['.ir', '.co.ir', '.ac.ir', '.sch.ir', '.gov.ir', '.org.ir', '.net.ir'];
        foreach ($tlds as $tld) if (str_ends_with($d, $tld)) return true;
        return false;
    }

    function checkAvailability($d) {
        if (function_exists('curl_init')) {
            $ch = curl_init("http://$d");
            curl_setopt_array($ch, [
                CURLOPT_NOBODY => true,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_TIMEOUT => 3,
                CURLOPT_CONNECTTIMEOUT => 3,
                CURLOPT_RETURNTRANSFER => true
            ]);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $code > 0;
        }
        $fp = @fsockopen($d, 80, $errno, $errstr, 3);
        if ($fp) { fclose($fp); return true; }
        return false;
    }

    function getAIResult($domain) {
        $prompt = "A foreign website '{$domain}' is not accessible. 
If it violates local laws or ethics, return:
{\"unethical\": true, \"explanation\": \"Short explanation\"}

Otherwise suggest 2-3 valid local alternatives in JSON format:
{\"unethical\": false, \"alternatives\": [{\"name\": \"Name\", \"url\": \"example.ir\", \"desc\": \"Short description\"}]}

Return only valid JSON.";

        $postData = [
            'model' => AI_MODEL,
            'messages' => [['role' => 'user', 'content' => $prompt]],
            'temperature' => 0.2,
            'max_tokens' => 350
        ];

        $ch = curl_init(AI_API_URL);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . AI_API_KEY,
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 12
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        if (!$response) return null;

        $res = json_decode($response, true);
        $content = $res['choices'][0]['message']['content'] ?? '';

        $content = trim($content);
        $content = preg_replace('/^
```json\s*/', '', $content);
$content = preg_replace('/\s*
```$/', '', $content);

        return json_decode($content, true);
    }

    $isIranian = isIranianDomain($domain);
    $status = checkAvailability($domain);
    $result = ['status' => $status ? 'open' : 'closed', 'is_iranian' => $isIranian];

    if ($status && !$isIranian) {
        $subs = file_exists($subFile) ? json_decode(file_get_contents($subFile), true) : [];
        $subs[] = ['domain' => $domain, 'date' => date('Y/m/d H:i')];
        file_put_contents($subFile, json_encode($subs, JSON_UNESCAPED_UNICODE));
        $result['submitted'] = true;
    }

    if (!$status && !$isIranian) {
        $ai = getAIResult($domain);
        if ($ai) {
            $result['unethical'] = $ai['unethical'] ?? false;
            $result['explanation'] = $ai['explanation'] ?? '';
            $result['alternatives'] = $ai['alternatives'] ?? [];
        } else {
            $result['unethical'] = false;
            $result['alternatives'] = [];
        }
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$news = file_exists($newsFile) ? json_decode(file_get_contents($newsFile), true) : [];
$news = is_array($news) ? array_reverse($news) : [];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NootySpeedTest | Internet Availability Checker</title>
<meta name="description" content="Check website accessibility and receive alternative suggestions using AI.">
<meta name="theme-color" content="#ff6b35">
</head>
<body style="background:#0b0b0f;color:#fff;font-family:sans-serif;text-align:center;padding:40px;">

<h1>⚡ NootySpeedTest</h1>
<p>Check website availability and get alternative suggestions using an AI Assistant.</p>

<input type="text" id="domainInput" placeholder="example.com" style="padding:10px;width:250px;">
<button onclick="checkDomain()" style="padding:10px 20px;">Check</button>

<div id="result" style="margin-top:20px;"></div>

<script>
async function checkDomain(){
    let domain = document.getElementById('domainInput').value.trim();
    if(!domain) return alert('Enter a domain');
    const res = await fetch('?action=check&domain=' + encodeURIComponent(domain));
    const data = await res.json();
    let html = '';
    if(data.status === 'open'){
        html = '✅ Domain is accessible.';
    } else {
        html = '❌ Domain is not accessible.';
        if(data.unethical){
            html += '<p>' + data.explanation + '</p>';
        } else if(data.alternatives && data.alternatives.length){
            html += '<ul>';
            data.alternatives.forEach(a=>{
                html += `<li><a href="http://${a.url}" target="_blank">${a.name}</a> - ${a.desc}</li>`;
            });
            html += '</ul>';
        }
    }
    document.getElementById('result').innerHTML = html;
}
</script>

</body>
</html>
