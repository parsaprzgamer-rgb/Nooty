<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NootyHide | حریم امن اطلاعات شما</title>
    <style>
        /* سیستم رنگی و متغیرها */
        :root {
            --bg-color: #030305;
            --surface-color: #0a0a0f;
            --surface-light: #12121a;
            --text-main: #f4f4f5;
            --text-muted: #a1a1aa;
            --accent-blue: #3b82f6;
            --accent-purple: #8b5cf6;
            --accent-cyan: #06b6d4;
            --card-border: rgba(255, 255, 255, 0.05);
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: system-ui, -apple-system, sans-serif; scroll-behavior: smooth; }
        body { background-color: var(--bg-color); color: var(--text-main); overflow-x: hidden; line-height: 1.8; }

        /* نورهای محیطی پس‌زمینه */
        .ambient-glow { position: fixed; width: 60vw; height: 60vw; max-width: 600px; max-height: 600px; border-radius: 50%; filter: blur(120px); z-index: -1; opacity: 0.12; animation: pulse-glow 10s infinite alternate ease-in-out; }
        .glow-blue { top: -20%; right: -10%; background: var(--accent-blue); }
        .glow-purple { bottom: -20%; left: -10%; background: var(--accent-purple); }
        @keyframes pulse-glow { 0% { transform: scale(1) translate(0, 0); } 100% { transform: scale(1.1) translate(-30px, 30px); } }

        /* ساختار کلی بخش‌ها */
        section { padding: 6rem 5%; max-width: 1300px; margin: 0 auto; position: relative; }
        .section-header { text-align: center; margin-bottom: 4rem; }
        .section-title { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 800; background: linear-gradient(135deg, #fff, #888); -webkit-background-clip: text; color: transparent; margin-bottom: 1rem; }
        .section-subtitle { color: var(--text-muted); font-size: clamp(0.95rem, 2vw, 1.1rem); max-width: 600px; margin: 0 auto; }

        /* نوار ناوبری حرفه‌ای (Navbar) */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 1rem 3%; max-width: 1200px; margin: 1.5rem auto; position: sticky; top: 1rem; z-index: 100; backdrop-filter: blur(20px); background: rgba(10, 10, 15, 0.75); border: 1px solid var(--card-border); border-radius: 24px; transition: var(--transition); box-shadow: 0 10px 40px rgba(0,0,0,0.3); }
        .logo { font-size: 1.6rem; font-weight: 900; letter-spacing: 1px; color: #fff; }
        .logo span { color: var(--accent-blue); }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; }
        .nav-links a { color: var(--text-main); text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: var(--transition); opacity: 0.8; }
        .nav-links a:hover { color: var(--accent-cyan); opacity: 1; }
        @media (max-width: 850px) { .nav-links { display: none; } nav { margin: 1rem 5%; } }

        /* هیرو سکشن (Hero) */
        .hero { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; min-height: 80vh; padding-top: 2rem; }
        .hero h1 { font-size: clamp(2.5rem, 6vw, 5.5rem); font-weight: 900; line-height: 1.15; margin-bottom: 1.5rem; letter-spacing: -1px; }
        .hero h1 .gradient-text { background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan)); -webkit-background-clip: text; color: transparent; }
        .hero p { font-size: clamp(1rem, 2vw, 1.25rem); color: var(--text-muted); max-width: 750px; margin-bottom: 3rem; line-height: 1.9; }
        
        /* انیمیشن وکتوری اختصاصی محافظ */
        .hero-vector { width: 100px; height: 100px; margin-bottom: 2rem; animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0); filter: drop-shadow(0 10px 20px rgba(59,130,246,0.2)); } 50% { transform: translateY(-15px); filter: drop-shadow(0 20px 30px rgba(59,130,246,0.4)); } }

        /* دکمه‌ها */
        .btn { padding: 0.9rem 2.2rem; border-radius: 14px; font-weight: 600; font-size: 1.05rem; text-decoration: none; display: inline-flex; align-items: center; gap: 12px; transition: var(--transition); border: none; cursor: pointer; }
        .btn-primary { background: #fff; color: #000; box-shadow: 0 0 30px rgba(255,255,255,0.1); }
        .btn-primary:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 10px 40px rgba(255,255,255,0.25); background: #f4f4f5; }
        .btn-outline { background: rgba(255,255,255,0.03); color: #fff; border: 1px solid var(--card-border); }
        .btn-outline:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.2); transform: translateY(-3px); }

        /* گرید متقارن (۴ ویژگی) */
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        @media (max-width: 1024px) { .grid-4 { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 600px) { .grid-4 { grid-template-columns: 1fr; } }

        .feature-card { background: var(--surface-color); border: 1px solid var(--card-border); padding: 2.5rem 2rem; border-radius: 24px; transition: var(--transition); }
        .feature-card:hover { transform: translateY(-8px); border-color: rgba(59,130,246,0.3); background: var(--surface-light); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .feature-icon { width: 44px; height: 44px; margin-bottom: 1.5rem; color: var(--accent-blue); }
        .feature-card h3 { font-size: 1.25rem; margin-bottom: 1rem; color: #fff; }

        /* گرید مخاطبان (۳ تایی) */
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
        @media (max-width: 900px) { .grid-3 { grid-template-columns: 1fr; } }
        .target-card { background: linear-gradient(145deg, var(--surface-color), var(--surface-light)); border: 1px solid var(--card-border); padding: 2.5rem; border-radius: 24px; }
        .target-card h3 { color: var(--accent-cyan); font-size: 1.3rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 10px; }

        /* مقایسه هوشمند */
        .compare-container { background: var(--surface-color); border: 1px solid var(--card-border); border-radius: 24px; overflow: hidden; }
        .compare-row { display: grid; grid-template-columns: 2fr 1fr 1fr; border-bottom: 1px solid var(--card-border); }
        .compare-row:last-child { border-bottom: none; }
        .compare-header { background: rgba(255,255,255,0.03); font-weight: 700; color: var(--text-muted); }
        .compare-cell { padding: 1.5rem 2rem; display: flex; align-items: center; }
        .cell-us { background: rgba(59,130,246,0.06); color: var(--accent-blue); font-weight: 700; border-right: 1px solid var(--card-border); border-left: 1px solid var(--card-border); }
        .cell-them { color: var(--text-muted); text-decoration: line-through; opacity: 0.5; }
        @media (max-width: 768px) { .compare-row { grid-template-columns: 1fr; text-align: center; } .compare-cell { justify-content: center; padding: 1rem; } .cell-us { border: none; border-top: 1px solid var(--card-border); border-bottom: 1px solid var(--card-border); } }

        /* درباره ما (تیم + فلسفه) */
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        @media (max-width: 900px) { .about-grid { grid-template-columns: 1fr; } }
        .about-card { padding: 3rem; border-radius: 24px; border: 1px solid var(--card-border); }
        .about-team { background: linear-gradient(to bottom right, rgba(59,130,246,0.05), transparent); border-color: rgba(59,130,246,0.2); }
        .about-product { background: linear-gradient(to bottom left, rgba(139,92,246,0.05), transparent); border-color: rgba(139,92,246,0.2); }
        .about-card h3 { font-size: 1.6rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 12px; }

        /* حمایت مالی (بدون حس گدایی) */
        .donate-box { background: var(--surface-color); padding: 5rem 3rem; border-radius: 24px; text-align: center; border: 1px solid rgba(139,92,246,0.3); position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(139,92,246,0.1); }
        .donate-box h2 { font-size: clamp(1.8rem, 3vw, 2.2rem); margin-bottom: 1.5rem; color: #fff; }
        .btn-pro-donate { background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue)); color: #fff; padding: 1.1rem 2.5rem; border-radius: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 10px; text-decoration: none; margin-top: 2.5rem; transition: var(--transition); border: none; }
        .btn-pro-donate:hover { transform: scale(1.05); box-shadow: 0 10px 30px rgba(139,92,246,0.4); }

        /* چت‌بات Nooty-Ai */
        .chatbot-container { position: fixed; bottom: 30px; right: 30px; z-index: 999; }
        .chatbot-btn { width: 65px; height: 65px; border-radius: 50%; background: #fff; color: #000; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 10px 30px rgba(255,255,255,0.2); transition: var(--transition); border: none; }
        .chatbot-btn:hover { transform: scale(1.1); box-shadow: 0 15px 40px rgba(255,255,255,0.3); }
        .chatbot-window { display: none; width: 360px; height: 500px; background: var(--bg-color); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; position: absolute; bottom: 85px; right: 0; box-shadow: 0 30px 60px rgba(0,0,0,0.6); flex-direction: column; overflow: hidden; }
        .chatbot-window.active { display: flex; animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        @media (max-width: 480px) { .chatbot-window { width: 90vw; right: -15px; height: 60vh; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px) scale(0.9); } to { opacity: 1; transform: translateY(0) scale(1); } }
        
        .chat-header { background: var(--surface-color); padding: 18px 20px; border-bottom: 1px solid var(--card-border); display: flex; justify-content: space-between; align-items: center; font-weight: bold; font-size: 1.1rem; }
        .chat-header span.close { cursor: pointer; color: var(--text-muted); font-size: 1.2rem; transition: color 0.2s; }
        .chat-header span.close:hover { color: #fff; }
        
        .chat-body { flex: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px; font-size: 0.95rem; }
        .chat-msg { padding: 12px 16px; border-radius: 16px; max-width: 85%; line-height: 1.6; }
        .msg-ai { background: rgba(255,255,255,0.06); align-self: flex-start; border-bottom-right-radius: 4px; border: 1px solid rgba(255,255,255,0.03); }
        .msg-user { background: var(--accent-blue); color: #fff; align-self: flex-end; border-bottom-left-radius: 4px; }
        
        .chat-input-area { padding: 15px; border-top: 1px solid var(--card-border); background: var(--surface-color); display: flex; gap: 10px; }
        .chat-input-area input { flex: 1; background: var(--bg-color); border: 1px solid var(--card-border); color: white; padding: 12px 15px; border-radius: 12px; outline: none; transition: border 0.3s; }
        .chat-input-area input:focus { border-color: var(--accent-blue); }
        .chat-input-area button { background: #fff; color: #000; border: none; padding: 0 15px; border-radius: 12px; cursor: pointer; display: flex; align-items: center; transition: transform 0.2s; }
        .chat-input-area button:active { transform: scale(0.95); }
        
        .chat-footer { text-align: center; font-size: 0.75rem; color: var(--text-muted); padding: 10px; background: var(--surface-color); border-top: 1px solid var(--card-border); }
        .chat-footer span { color: var(--accent-cyan); font-weight: bold; }

        /* انیمیشن اسکرول */
        .reveal { opacity: 0; transform: translateY(40px); transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* فوتر */
        footer { padding: 4rem 5%; border-top: 1px solid var(--card-border); margin-top: 4rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 2rem; }
        .footer-links a { color: var(--text-muted); text-decoration: none; margin-left: 1.5rem; transition: color 0.3s; display: inline-flex; align-items: center; gap: 6px;}
        .footer-links a:hover { color: #fff; }
    </style>
</head>
<body>

    <div class="ambient-glow glow-blue"></div>
    <div class="ambient-glow glow-purple"></div>

    <nav>
        <div class="logo" dir="ltr">Nooty<span>Hide</span></div>
        <ul class="nav-links">
            <li><a href="#features">معماری سیستم</a></li>
            <li><a href="#audience">مخاطبان</a></li>
            <li><a href="#compare">تفاوت ما</a></li>
            <li><a href="#about">درباره برند</a></li>
        </ul>
        <a href="tool.html" class="btn btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.95rem;">شروع رمزنگاری</a>
    </nav>

    <section class="hero reveal active">
        <!-- انیمیشن وکتوری اختصاصی محافظ امنیتی -->
        <svg class="hero-vector" viewBox="0 0 24 24" fill="none" stroke="url(#blue-cyan)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <defs>
                <linearGradient id="blue-cyan" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#3b82f6"/>
                    <stop offset="100%" stop-color="#06b6d4"/>
                </linearGradient>
            </defs>
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <rect x="9" y="11" width="6" height="6" rx="1" fill="#06b6d4" stroke="none"/>
        </svg>

        <h1>اطلاعات شما، <br><span class="gradient-text">حریم امن شماست.</span></h1>
        <p>بدون سرور، بدون پایگاه داده و کاملاً بی‌صدا. NootyHide اطلاعات حساس شما را پیش از خروج از مرورگر، مستقیماً به الگوریتم‌های <strong>رمزنگاری نظامی (AES-256)</strong> مجهز می‌کند.</p>
        
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
            <a href="tool.html" class="btn btn-primary">
                ورود به ابزار
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="#features" class="btn btn-outline">چرا NootyHide؟</a>
        </div>
    </section>

    <!-- ویژگی‌ها (متقارن ۴ تایی) -->
    <section id="features" class="reveal">
        <div class="section-header">
            <h2 class="section-title">چرا NootyHide؟</h2>
            <p class="section-subtitle">معماری شده برای افرادی که به فضای ابری و سرورهای متمرکز اعتمادی ندارند.</p>
        </div>
        <div class="grid-4">
            <div class="feature-card">
                <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <h3>رمزنگاری نظامی</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">بهره‌گیری کامل از <strong>AES-256-GCM</strong>. قفلی که شکستن آن حتی برای ابررایانه‌ها نیازمند میلیون‌ها سال زمان است.</p>
            </div>
            <div class="feature-card">
                <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                <h3>ناشناس بودن مطلق</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">نه ایمیلی می‌خواهیم، نه شماره تلفنی. معماری ما به گونه‌ای مهندسی شده که هویت شما کاملاً <strong>مخفی و غیرقابل ردیابی</strong> بماند.</p>
            </div>
            <div class="feature-card">
                <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                <h3>پردازش Client-Side</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">دیتای خام هرگز از دستگاه شما خارج نمی‌شود. پردازش و رمزنگاری منحصراً <strong>روی مرورگر خودتان</strong> انجام می‌گیرد.</p>
            </div>
            <div class="feature-card">
                <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
                <h3>دسترسی آنی</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">بدون نیاز به نصب اپلیکیشن. روی موبایل یا لپ‌تاپ، NootyHide در <strong>کسر از ثانیه</strong> برای حفاظت آماده است.</p>
            </div>
        </div>
    </section>

    <!-- مخاطبان (۳ تایی) -->
    <section id="audience" class="reveal">
        <div class="section-header">
            <h2 class="section-title">NootyHide برای چه کسانی است؟</h2>
        </div>
        <div class="grid-3">
            <div class="target-card">
                <h3>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    روزنامه‌نگاران و منابع
                </h3>
                <p style="color: var(--text-muted); font-size: 0.95rem;">انتقال امن اسناد محرمانه و محافظت از جان منابع خبری در محیط‌هایی که شبکه‌ها تحت شنود شدید قرار دارند.</p>
            </div>
            <div class="target-card">
                <h3>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                    تیم‌های توسعه و تجارت
                </h3>
                <p style="color: var(--text-muted); font-size: 0.95rem;">اشتراک‌گذاری کلیدهای API، پسورد سرورها و قراردادها بدون آنکه در سرور پیام‌رسان‌های معمولی ثبت و ضبط شوند.</p>
            </div>
            <div class="target-card">
                <h3>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                    طلبان حریم‌خصوصی‌
                </h3>
                <p style="color: var(--text-muted); font-size: 0.95rem;">افرادی که معتقدند مکالمات خصوصی، کالای تجاری شرکت‌های بزرگ نیستند و حق دارند آزادانه ارتباط برقرار کنند.</p>
            </div>
        </div>
    </section>

    <!-- مقایسه حرفه‌ای -->
    <section id="compare" class="reveal">
        <div class="section-header">
            <h2 class="section-title">تفاوت معماری ما</h2>
            <p class="section-subtitle">مقایسه ابزارهای رایج ذخیره‌سازی با معماری غیرمتمرکز NootyHide</p>
        </div>
        <div class="compare-container">
            <div class="compare-row compare-header">
                <div class="compare-cell">شاخص امنیتی</div>
                <div class="compare-cell cell-us" style="background:transparent; border:none; justify-content:center;">NootyHide</div>
                <div class="compare-cell" style="justify-content:center;">رقبای ابری</div>
            </div>
            <div class="compare-row">
                <div class="compare-cell">محل پردازش الگوریتم</div>
                <div class="compare-cell cell-us">مرورگر کاربر (کاملا آفلاین)</div>
                <div class="compare-cell cell-them">سرور شرکت سازنده</div>
            </div>
            <div class="compare-row">
                <div class="compare-cell">ذخیره‌سازی اطلاعات</div>
                <div class="compare-cell cell-us">بدون هیچ دیتابیس (صفر)</div>
                <div class="compare-cell cell-them">ذخیره روی کلاد (Cloud)</div>
            </div>
            <div class="compare-row">
                <div class="compare-cell">دسترسی سازنده به اطلاعات</div>
                <div class="compare-cell cell-us">غیرممکن (Zero-Knowledge)</div>
                <div class="compare-cell cell-them">قابلیت دسترسی ادمین</div>
            </div>
        </div>
    </section>

    <!-- درباره ما -->
    <section id="about" class="reveal">
        <div class="about-grid">
            <div class="about-card about-team">
                <h3 style="color: var(--accent-blue);">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    یک تیم کوچک، رسالتی بزرگ
                </h3>
                <p style="color: var(--text-muted); text-align: justify;">
                    توسعه NootyHide توسط یک نیروی مستقل و دانش‌آموزی کلید خورد؛ با این چشم‌انداز محکم که ابزارهای قدرتمند امنیت سایبری نباید تنها در انحصار غول‌های تکنولوژی باشند. ما یک مجموعه کوچک هستیم، اما هدفی جهانی داریم: <strong>بازگرداندن حق حریم خصوصی</strong> به دستان کاربران، فارغ از هرگونه محدودیت و سانسور.
                </p>
            </div>
            <div class="about-card about-product">
                <h3 style="color: var(--accent-purple);">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    فلسفه NootyHide
                </h3>
                <p style="color: var(--text-muted); text-align: justify;">
                    ما عمیقاً باور داریم <strong>امن‌ترین پایگاه داده، پایگاهی است که اصلا وجود نداشته باشد</strong>. NootyHide صرفاً یک اسکریپت ساده نیست؛ بلکه یک بیانیه عملی علیه جمع‌آوری داده‌های کاربران است. هسته سیستم به گونه‌ای نوشته شده که حتی تیم توسعه‌دهنده نیز <strong>هرگز</strong> امکان رهگیری پکیج‌های شما را نخواهد داشت.
                </p>
            </div>
        </div>
    </section>

    <!-- حمایت مالی (حرفه‌ای) -->
    <section id="donate" class="reveal">
        <div class="donate-box">
            <h2 style="font-weight: 800;">حفظ استقلال شبکه</h2>
            <p style="color: var(--text-muted); font-size: 1.15rem; max-width: 800px; margin: 0 auto; line-height: 1.9;">
                NootyHide یک پروژه مستقل و آزاد است. ما سرمایه‌گذار تجاری نداریم، تبلیغات نمایش نمی‌دهیم و <strong>داده‌های شما را نمی‌فروشیم</strong>. پایداری سرورها، هزینه هوش مصنوعی و توسعه مداوم این زیرساخت امنیتی، کاملاً بر بستر حمایت‌های داوطلبانه کاربرانی استوار است که به اینترنت آزاد و ایمن اهمیت می‌دهند.
            </p>
            <a href="https://reymit.ir/nooty" target="_blank" rel="noopener noreferrer" class="btn-pro-donate">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                حمایت مالی از پروژه (Reymit)
            </a>
        </div>
    </section>

    <!-- فوتر حرفه‌ای -->
    <footer>
        <div style="color: var(--text-muted);">
            <div class="logo" dir="ltr" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Nooty<span>Hide</span></div>
            <p>&copy; 2026 Nooty. حریم خصوصی، حق مسلم شماست.</p>
        </div>
        <div class="footer-links">
            <a href="https://ble.ir/nootysupport" target="_blank" rel="noopener noreferrer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                پشتیبانی بله
            </a>
            <a href="tel:09376618512">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                تماس با ما
            </a>
        </div>
    </footer>

    <!-- ویجت چت‌بات Nooty-Ai -->
    <div class="chatbot-container">
        <div class="chatbot-window" id="chatbot-window">
            <div class="chat-header">
                پشتیبانی هوشمند
                <span class="close" onclick="toggleChat()">✕</span>
            </div>
            <div class="chat-body" id="chat-body">
                <div class="chat-msg msg-ai">سلام! من <strong>Nooty-Ai</strong> هستم. درباره استاندارد رمزنگاری ما و یا نحوه کارکرد سیستم چه راهنمایی می‌توانم انجام دهم؟</div>
            </div>
            <div class="chat-input-area">
                <input type="text" id="chat-input" placeholder="سوال خود را بپرسید..." onkeypress="handleEnter(event)">
                <button onclick="sendMessage()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                </button>
            </div>
            <div class="chat-footer">توسعه یافته با <span>Nooty-Ai</span></div>
        </div>
        <button class="chatbot-btn" onclick="toggleChat()">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </button>
    </div>

    <!-- اسکریپت‌ها -->
    <script>
        // انیمیشن‌های اسکرول نرم
        const revealElements = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });
        revealElements.forEach(el => revealObserver.observe(el));

        // منطق ارتباط با بک‌اند چت‌بات (کاملا امن)
        function toggleChat() {
            document.getElementById('chatbot-window').classList.toggle('active');
        }

        function handleEnter(e) {
            if (e.key === 'Enter') sendMessage();
        }

        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            if (!message) return;

            const chatBody = document.getElementById('chat-body');
            
            const userMsg = document.createElement('div');
            userMsg.className = 'chat-msg msg-user';
            userMsg.textContent = message;
            chatBody.appendChild(userMsg);
            input.value = '';
            chatBody.scrollTop = chatBody.scrollHeight;

            const loadingMsg = document.createElement('div');
            loadingMsg.className = 'chat-msg msg-ai';
            loadingMsg.innerHTML = '<span style="opacity:0.5">در حال پردازش...</span>';
            chatBody.appendChild(loadingMsg);
            chatBody.scrollTop = chatBody.scrollHeight;

            try {
                // ارسال درخواست به فایل PHP روی هاست (جلوگیری از لو رفتن کلید)
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();
                chatBody.removeChild(loadingMsg);

                const aiMsg = document.createElement('div');
                aiMsg.className = 'chat-msg msg-ai';
                
                if(data.error) {
                    aiMsg.textContent = 'خطا: ' + data.error;
                } else if(data.choices && data.choices[0]) {
                    // تبدیل ستاره‌های بولد احتمالی AI به تگ strong در مرورگر
                    let aiText = data.choices[0].message.content;
                    aiText = aiText.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                    aiMsg.innerHTML = aiText;
                } else {
                    aiMsg.textContent = 'خطای نامشخص در شبکه Nooty-Ai رخ داد.';
                }
                chatBody.appendChild(aiMsg);

            } catch (error) {
                chatBody.removeChild(loadingMsg);
                const errorMsg = document.createElement('div');
                errorMsg.className = 'chat-msg msg-ai';
                errorMsg.textContent = 'عدم ارتباط با هسته Nooty-Ai. لطفاً اتصال شبکه را بررسی کنید.';
                chatBody.appendChild(errorMsg);
            }
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    </script>
</body>
</html>
