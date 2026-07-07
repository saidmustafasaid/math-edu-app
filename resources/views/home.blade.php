<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $lang === 'sw' ? 'MathEduApp - Jifunze Hisabati' : 'MathEduApp - Learn Math' }}</title>

    <!-- Google AdSense Auto Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9366093496716678"
     crossorigin="anonymous"></script>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VHHX6QYHMN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){ dataLayer.push(arguments); }
      gtag('js', new Date());
      gtag('config', 'G-VHHX6QYHMN');
    </script>

    <!-- PWA Meta Tags -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#16a34a">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:       #16a34a;
            --green-dark:  #15803d;
            --green-light: #dcfce7;
            --sky:         #0ea5e9;
            --sky-light:   #e0f2fe;
            --indigo:      #4338ca;
            --indigo-dark: #3730a3;
            --teal:        #0d9488;
            --orange:      #f97316;
            --purple:      #7c3aed;
            --blue:        #2563eb;
            --text:        #0f172a;
            --muted:       #475569;
            --border:      #e2e8f0;
        }

        body {
            font-family: 'Baloo 2', Arial, sans-serif;
            color: var(--text);
            background: #fff;
            line-height: 1.6;
        }

        /* ───── NAVBAR ───── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: #fff;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 6px rgba(0,0,0,0.06);
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 20px;
            font-weight: 800;
            color: var(--green);
            letter-spacing: -0.4px;
            white-space: nowrap;
        }
        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--green-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 900;
            color: var(--green);
            line-height: 1;
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .lang-toggle {
            display: flex;
            background: var(--sky-light);
            border-radius: 9999px;
            padding: 3px;
            gap: 2px;
        }
        .lang-btn {
            background: none;
            border: none;
            padding: 5px 14px;
            border-radius: 9999px;
            font-family: 'Baloo 2', sans-serif;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            color: var(--sky);
            transition: background 0.2s, color 0.2s;
        }
        .lang-btn.active { background: var(--green); color: #fff; }
        .btn-outline {
            display: inline-block;
            padding: 8px 20px;
            border: 2px solid var(--green);
            color: var(--green);
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700;
            font-size: 14px;
            border-radius: 9999px;
            text-decoration: none;
            transition: background 0.2s;
            cursor: pointer;
        }
        .btn-outline:hover { background: var(--green-light); }
        .btn-solid {
            display: inline-block;
            padding: 8px 22px;
            background: var(--green);
            color: #fff;
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700;
            font-size: 14px;
            border-radius: 9999px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-solid:hover { background: var(--green-dark); transform: translateY(-1px); }

        /* ───── HERO ───── */
        .hero {
            background: linear-gradient(140deg, #bae6fd 0%, #d1fae5 50%, #a7f3d0 100%);
            padding: 80px 24px 0;
            overflow: hidden;
        }
        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: flex-end;
            gap: 40px;
        }
        .hero-text { padding-bottom: 70px; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 9999px;
            padding: 5px 14px;
            font-size: 13px;
            font-weight: 700;
            color: var(--green-dark);
            margin-bottom: 20px;
            backdrop-filter: blur(4px);
        }
        .hero-badge svg { width: 14px; height: 14px; color: var(--green); }
        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 800;
            line-height: 1.12;
            color: #0c4a6e;
            margin-bottom: 20px;
            letter-spacing: -0.02em;
        }
        .hero-desc {
            font-size: 18px;
            color: #075985;
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 500px;
        }
        .hero-cta {
            display: inline-block;
            padding: 15px 44px;
            background: var(--indigo);
            color: #fff;
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700;
            font-size: 17px;
            border-radius: 9999px;
            text-decoration: none;
            box-shadow: 0 4px 18px rgba(67,56,202,0.35);
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .hero-cta:hover {
            background: var(--indigo-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(67,56,202,0.4);
        }
        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            position: relative;
            height: 340px;
        }
        .hero-circle {
            width: 260px;
            height: 260px;
            background: rgba(255,255,255,0.45);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid rgba(255,255,255,0.7);
            backdrop-filter: blur(6px);
        }
        .hero-sigma {
            font-size: 120px;
            font-weight: 900;
            color: var(--indigo);
            opacity: 0.55;
            line-height: 1;
            user-select: none;
        }
        .math-float {
            position: absolute;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            box-shadow: 0 4px 18px rgba(0,0,0,0.12);
            animation: floatBob 3s ease-in-out infinite;
            user-select: none;
        }
        @keyframes floatBob {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-12px); }
        }

        /* ───── SECTION COMMONS ───── */
        .section { padding: 80px 24px; }
        .section-inner { max-width: 1200px; margin: 0 auto; }
        .section-title {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 800;
            text-align: center;
            color: #0f172a;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }
        .section-sub {
            text-align: center;
            color: var(--muted);
            font-size: 17px;
            margin-bottom: 48px;
            max-width: 580px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ───── DIVIDER CTA ───── */
        .divider-cta {
            text-align: center;
            margin-bottom: 48px;
        }
        .divider-cta a {
            display: inline-block;
            padding: 13px 40px;
            background: var(--indigo);
            color: #fff;
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700;
            font-size: 16px;
            border-radius: 9999px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(67,56,202,0.25);
            transition: background 0.2s, transform 0.15s;
        }
        .divider-cta a:hover { background: var(--indigo-dark); transform: translateY(-1px); }

        /* ───── FEATURE CARDS ───── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
        .card {
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 18px;
            padding: 36px 28px 28px;
            text-align: center;
            transition: box-shadow 0.25s, transform 0.25s, border-color 0.25s;
            cursor: pointer;
            text-decoration: none;
            display: block;
            color: inherit;
        }
        .card:hover {
            box-shadow: 0 10px 36px rgba(0,0,0,0.1);
            transform: translateY(-5px);
            border-color: transparent;
        }
        .card-icon {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
        }
        .card-icon svg { width: 32px; height: 32px; }
        .ci-green  { background: #dcfce7; }
        .ci-blue   { background: #dbeafe; }
        .ci-purple { background: #ede9fe; }
        .ci-orange { background: #ffedd5; }
        .ci-teal   { background: #ccfbf1; }
        .card-title {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 12px;
        }
        .card-desc {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.65;
            margin-bottom: 22px;
        }
        .card-btn {
            display: inline-block;
            padding: 10px 30px;
            color: #fff;
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700;
            font-size: 14px;
            border-radius: 9999px;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
        }
        .card-btn:hover { opacity: 0.88; transform: translateY(-1px); }
        .card-full { grid-column: 1 / -1; max-width: 540px; margin: 0 auto; width: 100%; }

        /* ───── STATS ───── */
        .stats-section {
            background: #4338ca;
            padding: 80px 24px;
        }
        .stats-section .section-title { color: #fff; }
        .stats-section .section-sub   { color: #c7d2fe; }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 60px;
        }
        .stat-box {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
        }
        .stat-num {
            font-size: clamp(2.4rem, 5vw, 3.8rem);
            font-weight: 800;
            color: #fbbf24;
            line-height: 1;
            margin-bottom: 8px;
        }
        .stat-lbl { color: #e0e7ff; font-size: 15px; font-weight: 500; }
        .stat-icons-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 32px;
            flex-wrap: wrap;
        }
        .stat-icon-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .stat-icon-ring {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-icon-ring svg { width: 40px; height: 40px; color: #fff; }
        .stat-icon-lbl { color: #c7d2fe; font-size: 13px; font-weight: 600; }

        /* ───── TESTIMONIALS ───── */
        .testimonials-section { background: #3730a3; padding: 80px 24px; }
        .testimonials-section .section-title { color: #fff; }
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-top: 40px;
        }
        .t-card {
            background: #fff;
            border-radius: 18px;
            padding: 28px;
            position: relative;
        }
        .t-text {
            font-size: 15px;
            color: #1e293b;
            line-height: 1.75;
            margin-bottom: 20px;
            font-style: italic;
        }
        .t-author { font-size: 14px; font-weight: 800; color: #0f172a; }
        .t-role   { font-size: 13px; color: var(--muted); margin-top: 2px; }
        .t-tail {
            position: absolute;
            bottom: -13px;
            left: 28px;
            width: 0; height: 0;
            border-left: 13px solid transparent;
            border-top: 13px solid #fff;
        }

        /* ───── UNLOCK ───── */
        .unlock-section { background: #fef9c3; padding: 80px 24px; }
        .unlock-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }
        .unlock-title {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }
        .unlock-desc { font-size: 16px; color: var(--muted); line-height: 1.75; margin-bottom: 32px; }
        .check-list { list-style: none; display: flex; flex-direction: column; gap: 16px; }
        .check-list li { display: flex; align-items: flex-start; gap: 12px; font-size: 15px; color: var(--text); }
        .check-dot {
            width: 24px; height: 24px;
            background: var(--green);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .check-dot svg { width: 13px; height: 13px; color: #fff; }
        .symbol-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .sym-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px;
            text-align: center;
            box-shadow: 0 2px 14px rgba(0,0,0,0.07);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .sym-card:hover { transform: translateY(-3px); box-shadow: 0 6px 22px rgba(0,0,0,0.1); }
        .sym-num { font-size: 2.2rem; font-weight: 900; color: var(--indigo); }
        .sym-lbl { font-size: 13px; color: var(--muted); margin-top: 4px; }

        /* ───── FINAL CTA ───── */
        .final-cta {
            background: linear-gradient(135deg, #bae6fd 0%, #a7f3d0 100%);
            padding: 100px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .final-cta::before {
            content: '∑';
            position: absolute;
            right: -40px;
            top: -30px;
            font-size: 300px;
            font-weight: 900;
            color: rgba(67,56,202,0.06);
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }
        .final-cta-title {
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800;
            color: #0c4a6e;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }
        .final-cta-sub {
            font-size: 18px;
            color: #075985;
            margin-bottom: 36px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ───── FOOTER ───── */
        footer { background: #0f172a; padding: 64px 24px 40px; }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 48px;
            border-bottom: 1px solid #1e293b;
        }
        .footer-brand { font-size: 18px; font-weight: 800; color: #fff; margin-bottom: 12px; }
        .footer-tagline { font-size: 14px; color: #64748b; line-height: 1.65; }
        .footer-col-hd {
            font-size: 12px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 16px;
        }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: #fff; }
        .footer-bottom {
            padding-top: 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-copy { font-size: 13px; color: #475569; }
        .social-row { display: flex; gap: 10px; }
        .soc-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .soc-btn:hover { background: var(--green); color: #fff; }
        .soc-btn svg { width: 15px; height: 15px; }

        /* ───── RESPONSIVE ───── */
        @media (max-width: 900px) {
            .hero-inner   { grid-template-columns: 1fr; }
            .hero-visual  { display: none; }
            .hero-text    { padding-bottom: 60px; }
            .unlock-inner { grid-template-columns: 1fr; }
            .symbol-grid  { display: none; }
            .footer-top   { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 640px) {
            .section       { padding: 56px 20px; }
            .cards-grid    { grid-template-columns: 1fr; }
            .stats-grid    { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .footer-top    { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; align-items: flex-start; }
            .btn-outline   { display: none; }
        }
        @media (prefers-reduced-motion: reduce) {
            .math-float { animation: none !important; }
            * { transition-duration: 0ms !important; }
        }
    </style>
</head>

<body>

    <!-- ═══════ NAVBAR ═══════ -->
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-icon">∑</span>
                MathEduApp
            </a>
            <div class="nav-actions">
                <div class="lang-toggle">
                    <button class="lang-btn {{ $lang === 'en' ? 'active' : '' }}" onclick="changeLang('en')">EN</button>
                    <button class="lang-btn {{ $lang === 'sw' ? 'active' : '' }}" onclick="changeLang('sw')">SW</button>
                </div>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-solid">
                        {{ $lang === 'sw' ? 'Dashibodi' : 'My Dashboard' }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">
                        {{ $lang === 'sw' ? 'Ingia' : 'Log In' }}
                    </a>
                    <a href="{{ route('register') }}" class="btn-solid">
                        {{ $lang === 'sw' ? 'Jisajili' : 'Sign Up' }}
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- ═══════ HERO ═══════ -->
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    {{ $lang === 'sw' ? 'Programu ya Wanafunzi wa Tanzania' : 'For Tanzanian Students' }}
                </div>
                <h1 class="hero-title">
                    {{ $lang === 'sw'
                        ? 'Jifunze Hisabati kwa Njia ya Kisasa'
                        : 'Splash into Math Learning' }}
                </h1>
                <p class="hero-desc">
                    {{ $lang === 'sw'
                        ? 'Gundua zana za kisasa — mifumo 127+, kikokotoo cha kisayansi, kibadilisha vitengo na thamani za kisayansi, zote kwa lugha ya Kiswahili na Kiingereza.'
                        : 'Explore 127+ math formulas, scientific calculator, unit converter, and constants — all in Swahili and English, built for Tanzanian students.' }}
                </p>
                @auth
                    <a href="{{ route('dashboard') }}" class="hero-cta">
                        {{ $lang === 'sw' ? 'Nenda Dashibodini' : 'Go to Dashboard' }}
                    </a>
                @else
                    <a href="{{ route('register') }}" class="hero-cta">
                        {{ $lang === 'sw' ? 'Anza Bure Leo' : 'Join for free' }}
                    </a>
                @endauth
            </div>
            <div class="hero-visual">
                <!-- floating math symbols -->
                <div class="math-float" style="width:72px;height:72px;font-size:24px;color:var(--indigo);top:30px;left:20px;animation-delay:0s;">π</div>
                <div class="math-float" style="width:62px;height:62px;font-size:22px;color:var(--green);top:120px;left:190px;animation-delay:0.6s;">∫</div>
                <div class="math-float" style="width:80px;height:80px;font-size:20px;color:var(--orange);top:10px;left:260px;animation-delay:0.3s;">√x</div>
                <div class="math-float" style="width:58px;height:58px;font-size:16px;color:var(--teal);top:180px;left:50px;animation-delay:1.1s;">a²+b²</div>
                <div class="math-float" style="width:68px;height:68px;font-size:26px;color:var(--purple);top:175px;left:290px;animation-delay:0.5s;">Σ</div>
                <div class="hero-circle" style="position:absolute;bottom:0;left:50%;transform:translateX(-50%);">
                    <span class="hero-sigma">∑</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ LEARNING LIBRARY ═══════ -->
    <section class="section" style="background:#f8fafc;">
        <div class="section-inner">
            <h2 class="section-title">
                {{ $lang === 'sw' ? 'Maktaba yetu ya Kujifunza' : 'Our Learning Library' }}
            </h2>
            <p class="section-sub">
                {{ $lang === 'sw'
                    ? 'Zana elfu za kidijitali — pata zana bora kwa masomo yako ya Hisabati.'
                    : 'Thousands of digital resources — find the best tool for your Math studies.' }}
            </p>
            <div class="divider-cta">
                <a href="{{ route('formulas', ['lang' => $lang]) }}">
                    {{ $lang === 'sw' ? 'Chunguza Zana' : 'Dive right in' }}
                </a>
            </div>

            <div class="cards-grid">
                <!-- Formulas -->
                <a href="{{ route('formulas', ['lang' => $lang]) }}" class="card">
                    <div class="card-icon ci-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 7h16M4 12h10M4 17h7"/>
                            <rect x="14" y="13" width="7" height="7" rx="1.5"/>
                        </svg>
                    </div>
                    <div class="card-title" style="color:var(--teal);">{{ $lang === 'sw' ? 'Mifumo ya Hisabati' : 'Math Formulas' }}</div>
                    <p class="card-desc">{{ $lang === 'sw' ? 'Mifumo 127+ iliyoandaliwa awali inafanya iwe rahisi kufundisha masomo yote ya Hisabati — aljebra, jiometri, trigonometriki na zaidi.' : 'Free, ready-made formulas make it easy to study any math topic — algebra, geometry, trigonometry, calculus and more.' }}</p>
                    <span class="card-btn" style="background:var(--indigo);">{{ $lang === 'sw' ? 'Angalia Mifumo' : 'Browse formulas' }}</span>
                </a>
                <!-- Calculator -->
                <a href="{{ route('calculator', ['lang' => $lang]) }}" class="card">
                    <div class="card-icon ci-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2"/>
                            <line x1="8" y1="6" x2="16" y2="6"/>
                            <line x1="8" y1="10" x2="10" y2="10"/><line x1="14" y1="10" x2="16" y2="10"/>
                            <line x1="8" y1="14" x2="10" y2="14"/><line x1="14" y1="14" x2="16" y2="14"/>
                            <line x1="8" y1="18" x2="16" y2="18"/>
                        </svg>
                    </div>
                    <div class="card-title" style="color:var(--blue);">{{ $lang === 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator' }}</div>
                    <p class="card-desc">{{ $lang === 'sw' ? 'Kikokotoo kamili cha kisayansi kwa mahesabu ya trigonometriki, logarithm, nguvu, na mahesabu magumu zaidi.' : 'Full-featured scientific calculator for trig, logarithms, exponents, and complex computations — works offline too!' }}</p>
                    <span class="card-btn" style="background:var(--blue);">{{ $lang === 'sw' ? 'Fungua Kikokotoo' : 'Open calculator' }}</span>
                </a>
                <!-- Converter -->
                <a href="{{ route('converter', ['lang' => $lang]) }}" class="card">
                    <div class="card-icon ci-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 16V4m0 0L3 8m4-4l4 4"/>
                            <path d="M17 8v12m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <div class="card-title" style="color:var(--purple);">{{ $lang === 'sw' ? 'Kibadilisha Vitengo' : 'Unit Converter' }}</div>
                    <p class="card-desc">{{ $lang === 'sw' ? 'Badilisha vitengo kwa urahisi na usahihi — umbali, uzito, joto, eneo, na mengi zaidi kwa haraka bila makosa.' : 'Convert units instantly and accurately — length, mass, temperature, area, volume and many more.' }}</p>
                    <span class="card-btn" style="background:var(--purple);">{{ $lang === 'sw' ? 'Badilisha Sasa' : 'Convert now' }}</span>
                </a>
                <!-- Angles -->
                <a href="{{ route('angles', ['lang' => $lang]) }}" class="card">
                    <div class="card-icon ci-orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18"/>
                            <path d="M3 21L12 3l9 18"/>
                            <path d="M8.5 21l3.5-7.5 3.5 7.5"/>
                        </svg>
                    </div>
                    <div class="card-title" style="color:var(--orange);">{{ $lang === 'sw' ? 'Pembe Maarufu' : 'Angle Values' }}</div>
                    <p class="card-desc">{{ $lang === 'sw' ? 'Thamani za pembe za trigonometriki kwa pembe zote maarufu — sin, cos, tan na mipinzani yao yote imeandikwa wazi.' : 'Trigonometric values for all standard angles — sin, cos, tan and their inverses, clearly presented.' }}</p>
                    <span class="card-btn" style="background:var(--orange);">{{ $lang === 'sw' ? 'Angalia Pembe' : 'View angles' }}</span>
                </a>
                <!-- Constants (full width) -->
                <a href="{{ url('constants') }}?lang={{ $lang }}" class="card card-full">
                    <div class="card-icon ci-teal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    <div class="card-title" style="color:var(--teal);">{{ $lang === 'sw' ? 'Thamani za Kisayansi' : 'Scientific Constants' }}</div>
                    <p class="card-desc">{{ $lang === 'sw' ? 'Thamani za kimwili na kisayansi — kasi ya mwanga, nambari ya Avogadro, mvuto wa ulimwengu na zaidi, zote mahali pamoja.' : 'Physical and scientific constants — speed of light, Avogadro\'s number, gravitational constant and more, all in one place.' }}</p>
                    <span class="card-btn" style="background:var(--teal);">{{ $lang === 'sw' ? 'Angalia Thamani' : 'View constants' }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════ UNLOCK POTENTIAL ═══════ -->
    <section class="unlock-section">
        <div class="unlock-inner">
            <div>
                <h2 class="unlock-title">
                    {{ $lang === 'sw' ? 'Fungua Uwezo wako wa Kweli wa Hisabati' : "Unlock Every Student's True Math Potential" }}
                </h2>
                <p class="unlock-desc">
                    {{ $lang === 'sw'
                        ? 'Programu yetu inakupa ufikiaji wa zana zote za hisabati — mifumo, kikokotoo, kibadilisha, na thamani za kisayansi — zote zinafanya kazi bila mtandao kama programu ya simu.'
                        : 'Our platform gives you unlimited access to all math tools — formulas, calculator, converter, and scientific constants — all working offline as a mobile app.' }}
                </p>
                <ul class="check-list">
                    <li>
                        <span class="check-dot">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span>{{ $lang === 'sw' ? 'Mifumo 127+ iliyopangwa kwa mada zote za Hisabati' : '127+ formulas covering all math topics' }}</span>
                    </li>
                    <li>
                        <span class="check-dot">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span>{{ $lang === 'sw' ? 'Kikokotoo cha kisayansi kinachofanya kazi bila mtandao' : 'Scientific calculator works fully offline (PWA)' }}</span>
                    </li>
                    <li>
                        <span class="check-dot">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span>{{ $lang === 'sw' ? 'Inafanya kazi kikamilifu kwa Kiswahili na Kiingereza' : 'Fully bilingual — Swahili and English' }}</span>
                    </li>
                    <li>
                        <span class="check-dot">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span>{{ $lang === 'sw' ? 'Inaweza kusakinishwa kama programu ya simu (PWA)' : 'Installable as a phone app (PWA) — no app store needed' }}</span>
                    </li>
                    <li>
                        <span class="check-dot">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span>{{ $lang === 'sw' ? 'Bure kabisa — hakuna ada ya kufuata' : 'Completely free — no hidden charges' }}</span>
                    </li>
                </ul>
            </div>
            <div class="symbol-grid">
                <div class="sym-card">
                    <div class="sym-num">π</div>
                    <div class="sym-lbl">{{ $lang === 'sw' ? 'Trigonometriki' : 'Trigonometry' }}</div>
                </div>
                <div class="sym-card">
                    <div class="sym-num">∫</div>
                    <div class="sym-lbl">{{ $lang === 'sw' ? 'Hisabati ya Juu' : 'Calculus' }}</div>
                </div>
                <div class="sym-card">
                    <div class="sym-num">∑</div>
                    <div class="sym-lbl">{{ $lang === 'sw' ? 'Msururu' : 'Series' }}</div>
                </div>
                <div class="sym-card">
                    <div class="sym-num">√</div>
                    <div class="sym-lbl">{{ $lang === 'sw' ? 'Aljebra' : 'Algebra' }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ STATS ═══════ -->
    <section class="stats-section">
        <div class="section-inner">
            <h2 class="section-title">{{ $lang === 'sw' ? 'Jiunge na Jumuiya ya MathEduApp!' : 'Join the MathEduApp Community!' }}</h2>
            <p class="section-sub" style="color:#c7d2fe;">
                {{ $lang === 'sw'
                    ? 'Programu inayotumiwa na wanafunzi na walimu kutoka Tanzania na nje ya nchi.'
                    : 'Trusted by students and teachers across Tanzania and beyond.' }}
            </p>
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-num">127+</div>
                    <div class="stat-lbl">{{ $lang === 'sw' ? 'Mifumo ya Hisabati' : 'Math Formulas' }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-num">5</div>
                    <div class="stat-lbl">{{ $lang === 'sw' ? 'Zana za Kujifunza' : 'Learning Tools' }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-num">2</div>
                    <div class="stat-lbl">{{ $lang === 'sw' ? 'Lugha Zinazoungwa mkono' : 'Languages Supported' }}</div>
                </div>
            </div>
            <div class="stat-icons-row">
                <div class="stat-icon-item">
                    <div class="stat-icon-ring">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16M4 12h10M4 17h7"/><rect x="14" y="13" width="7" height="7" rx="1"/></svg>
                    </div>
                    <span class="stat-icon-lbl">{{ $lang === 'sw' ? 'Mifumo' : 'Formulas' }}</span>
                </div>
                <div class="stat-icon-item">
                    <div class="stat-icon-ring">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="10" y2="10"/><line x1="14" y1="10" x2="16" y2="10"/></svg>
                    </div>
                    <span class="stat-icon-lbl">{{ $lang === 'sw' ? 'Kikokotoo' : 'Calculator' }}</span>
                </div>
                <div class="stat-icon-item">
                    <div class="stat-icon-ring">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16V4m0 0L3 8m4-4l4 4"/><path d="M17 8v12m0 0l4-4m-4 4l-4-4"/></svg>
                    </div>
                    <span class="stat-icon-lbl">{{ $lang === 'sw' ? 'Kibadilisha' : 'Converter' }}</span>
                </div>
                <div class="stat-icon-item">
                    <div class="stat-icon-ring">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <span class="stat-icon-lbl">{{ $lang === 'sw' ? 'Thamani' : 'Constants' }}</span>
                </div>
                <div class="stat-icon-item">
                    <div class="stat-icon-ring">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M3 21L12 3l9 18"/></svg>
                    </div>
                    <span class="stat-icon-lbl">{{ $lang === 'sw' ? 'Pembe' : 'Angles' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ TESTIMONIALS ═══════ -->
    <section class="testimonials-section">
        <div class="section-inner">
            <h2 class="section-title">{{ $lang === 'sw' ? 'Wanasema Nini?' : 'What Students Say' }}</h2>
            <div class="testimonials-grid">
                <div class="t-card">
                    <p class="t-text">
                        {{ $lang === 'sw'
                            ? '"MathEduApp inanisaidia sana katika masomo yangu ya Hisabati. Napenda jinsi mifumo iko tayari na kikokotoo ni rahisi kutumia — hata bila mtandao."'
                            : '"MathEduApp has been incredibly helpful for my Math studies. I love how formulas are ready and the calculator is easy to use — even without internet."' }}
                    </p>
                    <div class="t-author">Amina M.</div>
                    <div class="t-role">{{ $lang === 'sw' ? 'Mwanafunzi wa Kidato cha 6, Dar es Salaam' : 'Form 6 Student, Dar es Salaam' }}</div>
                    <div class="t-tail"></div>
                </div>
                <div class="t-card">
                    <p class="t-text">
                        {{ $lang === 'sw'
                            ? '"Kama mwalimu, napenda jinsi programu hii inavyofanya kazi kwa Kiswahili na Kiingereza. Inasaidia wanafunzi wote kuelewa Hisabati vizuri zaidi."'
                            : '"As a math teacher, I love that this app works in both Swahili and English. It helps all my students understand math better, regardless of their language preference."' }}
                    </p>
                    <div class="t-author">{{ $lang === 'sw' ? 'Mwalimu Hassan K.' : 'Teacher Hassan K.' }}</div>
                    <div class="t-role">{{ $lang === 'sw' ? 'Mwalimu wa Hisabati, Mwanza' : 'Mathematics Teacher, Mwanza' }}</div>
                    <div class="t-tail"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ FINAL CTA ═══════ -->
    <section class="final-cta">
        <div class="section-inner" style="position:relative;z-index:1;">
            <h2 class="final-cta-title">
                {{ $lang === 'sw' ? 'Pata Ufikiaji Leo!' : 'Get Access Today!' }}
            </h2>
            <p class="final-cta-sub">
                {{ $lang === 'sw'
                    ? 'Jiunge bure na upate ufikiaji wa zana zote za Hisabati mara moja.'
                    : 'Join for free and get instant access to all math learning tools.' }}
            </p>
            @auth
                <a href="{{ route('dashboard') }}" class="hero-cta">
                    {{ $lang === 'sw' ? 'Nenda Dashibodini' : 'Go to Dashboard' }}
                </a>
            @else
                <a href="{{ route('register') }}" class="hero-cta">
                    {{ $lang === 'sw' ? 'Jiunge Bure' : 'Join for free' }}
                </a>
            @endauth
        </div>
    </section>

    <!-- ═══════ FOOTER ═══════ -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div>
                    <div class="footer-brand">∑ MathEduApp</div>
                    <p class="footer-tagline">
                        {{ $lang === 'sw'
                            ? 'Programu ya kujifunza Hisabati iliyoundwa kwa wanafunzi wa Tanzania. Mifumo, kikokotoo, kibadilisha vitengo, pembe, na thamani za kisayansi — zote bure na zinafanya kazi bila mtandao.'
                            : 'A math learning platform built for Tanzanian students. Formulas, calculator, unit converter, angles, and scientific constants — all free and offline-ready.' }}
                    </p>
                </div>
                <div>
                    <div class="footer-col-hd">{{ $lang === 'sw' ? 'Zana' : 'Tools' }}</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('formulas', ['lang' => $lang]) }}">{{ $lang === 'sw' ? 'Mifumo' : 'Formulas' }}</a></li>
                        <li><a href="{{ route('calculator', ['lang' => $lang]) }}">{{ $lang === 'sw' ? 'Kikokotoo' : 'Calculator' }}</a></li>
                        <li><a href="{{ route('converter', ['lang' => $lang]) }}">{{ $lang === 'sw' ? 'Kibadilisha' : 'Converter' }}</a></li>
                        <li><a href="{{ route('angles', ['lang' => $lang]) }}">{{ $lang === 'sw' ? 'Pembe' : 'Angles' }}</a></li>
                        <li><a href="{{ url('constants') }}?lang={{ $lang }}">{{ $lang === 'sw' ? 'Thamani' : 'Constants' }}</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-hd">{{ $lang === 'sw' ? 'Akaunti' : 'Account' }}</div>
                    <ul class="footer-links">
                        @auth
                            <li><a href="{{ route('dashboard') }}">{{ $lang === 'sw' ? 'Dashibodi' : 'Dashboard' }}</a></li>
                            <li><a href="{{ route('profile.edit') }}">{{ $lang === 'sw' ? 'Wasifu' : 'Profile' }}</a></li>
                        @else
                            <li><a href="{{ route('login') }}">{{ $lang === 'sw' ? 'Ingia' : 'Log In' }}</a></li>
                            <li><a href="{{ route('register') }}">{{ $lang === 'sw' ? 'Jisajili' : 'Sign Up' }}</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <div class="footer-col-hd">{{ $lang === 'sw' ? 'Lugha' : 'Language' }}</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}?lang=en">English</a></li>
                        <li><a href="{{ route('home') }}?lang=sw">Kiswahili</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copy">
                    &copy; {{ date('Y') }} MathEduApp &bull;
                    {{ $lang === 'sw' ? 'Haki Zote Zimehifadhiwa' : 'All Rights Reserved' }}
                </p>
                <div class="social-row">
                    <a href="#" class="soc-btn" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="soc-btn" aria-label="Twitter / X">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                    <a href="#" class="soc-btn" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.4 19.5C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#0f172a"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Language switch -->
    <script>
        function changeLang(lang) {
            window.location.href = "{{ route('home') }}" + "?lang=" + lang;
        }
    </script>

    <!-- Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js')
                .then(reg => console.log('SW registered:', reg.scope))
                .catch(err => console.error('SW failed:', err));
        }
    </script>
</body>
</html>
