<?php
// ===============================================
//  NootyHide API Example (Safe for Public GitHub)
//  This file contains NO real keys, NO real URLs.
//  Replace values in api.php on your server only.
// ===============================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// IMPORTANT:
// Insert your real API key ONLY in api.php on the server.
// Never commit real keys to GitHub.
$api_key = ''; // EMPTY FOR PUBLIC VERSION

// Example placeholder URL (replace on server)
$url = 'https://your-ai-endpoint.example.com/v1/chat/completions';

// Read input JSON
$data = json_decode(file_get_contents('php://input'), true);
$user_message = $data['message'] ?? '';

if (empty($user_message)) {
    echo json_encode(['error' => 'No message received.']);
    exit;
}

// Example system prompt (public-safe, no identity disclosure)
$system_prompt = "You are an AI assistant for NootyHide public edition. 
Provide short, helpful answers about encryption concepts and the tool's features. 
Avoid giving technical instructions related to server management or sensitive operations.";

// JSON payload (public-safe)
$payload = json_encode([
    'model' => 'your-model-name', // placeholder, not real
    'messages' => [
        ['role' => 'system', 'content' => $system_prompt],
        ['role' => 'user', 'content' => $user_message]
    ]
]);

// Curl request — safe structure, no secrets
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key
]);

$response = curl_exec($ch);
curl_close($ch);

// Output API result
echo $response;
?>
