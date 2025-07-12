<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $lang == 'sw' ? 'UKURASA WA NYUMBANI' : 'HOME PAGE' }}</title>

    <!-- ✅ Google AdSense Auto Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9366093496716678"
     crossorigin="anonymous"></script>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VHHX6QYHMN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-VHHX6QYHMN');
    </script>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Arial Black', Arial, sans-serif;
            background-color: #f3f4f6;
            color: #222;
        }
        .content {
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #4f46e5;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 32px;
            margin-bottom: 20px;
        }
        .lang-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .lang-buttons button {
            background: #4f46e5;
            border: none;
            color: #fff;
            font-weight: 900;
            padding: 12px 28px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.25s;
            font-size: 16px;
        }
        .lang-buttons button:hover {
            background: #3b31a1;
        }
        .sidebar {
            width: 100%;
            padding: 25px 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar a {
            color: #4f46e5;
            text-decoration: none;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 8px;
            font-weight: 900;
            text-transform: uppercase;
            transition: background 0.3s ease, color 0.3s ease;
            text-align: center;
            width: 90%;
            max-width: 1000px;
            font-size: 18px;
        }
        .sidebar a:hover {
            background: #e0e7ff;
            color: #1e3a8a;
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px;
            }
            h1 {
                font-size: 24px;
            }
            .lang-buttons button {
                font-size: 14px;
                padding: 10px 20px;
            }
            .sidebar a {
                font-size: 16px;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<!-- PWA Support -->
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#007BFF">

<!-- iOS + Android PWA support -->
<link rel="apple-touch-icon" href="/icons/icon-192.png">
<meta name="mobile-web-app-capable" content="yes"> <!-- ✅ NEW and recommended -->
<meta name="apple-mobile-web-app-capable" content="yes"> <!-- (still okay to keep) -->
<meta name="apple-mobile-web-app-status-bar-style" content="default">


<!-- Service Worker -->
<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/serviceworker.js')
      .then(function(registration) {
        console.log('Service Worker registered with scope:', registration.scope);
      }).catch(function(error) {
        console.error('Service Worker registration failed:', error);
      });
  }
</script>

<body>

    <div class="content">
        <h1>{{ $lang == 'en' ? 'WELCOME TO TANZANIAN STUDENTS APP' : 'KARIBU KWENYE PROGRAMU YA WANAFUNZI WA TANZANIA' }}</h1>

        <div class="lang-buttons">
            <button onclick="changeLang('en')">ENGLISH</button>
            <button onclick="changeLang('sw')">KISWAHILI</button>
        </div>

        <p>{{ $lang == 'en' ? 'Please select a service from the menu below.' : 'Tafadhali chagua huduma kutoka kwenye menyu hapa chini.' }}</p>
    </div>

    <div class="sidebar">
        @if($lang == 'en')
            <a href="{{ route('converter', ['lang' => $lang]) }}">UNIT CONVERTER</a>
            <a href="{{ route('calculator', ['lang' => $lang]) }}">
                {{ $lang == 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator' }}
            </a>
            <a href="{{ route('formulas', ['lang' => $lang]) }}">
                {{ $lang == 'sw' ? 'Mifumo ya Hisabati' : 'Mathematical Formulas' }}
            </a>
            <a href="{{ route('angles', ['lang' => $lang ?? 'en']) }}">
                {{ $lang == 'sw' ? 'Pembe Maarufu' : 'Angle Values' }}
            </a>
            <a href="{{ url('constants') }}?lang={{ $lang ?? 'en' }}" 
                style="color:#4f46e5; font-weight: bold; text-decoration: none;">
                {{ $lang == 'sw' ? 'THAMANI' : 'CONSTANTS' }}
            </a>
        @else
            <a href="{{ route('converter', ['lang' => $lang]) }}">KIBADILISHA VITENGO</a>
            <a href="{{ route('calculator', ['lang' => $lang]) }}">
                {{ $lang == 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator' }}
            </a>
            <a href="{{ route('formulas', ['lang' => $lang]) }}">
                {{ $lang == 'sw' ? 'Mifumo ya Hisabati' : 'Mathematical Formulas' }}
            </a>
            <a href="{{ route('angles', ['lang' => $lang ?? 'en']) }}">
                {{ $lang == 'sw' ? 'Pembe Maarufu' : 'Angle Values' }}
            </a>
            <a href="{{ url('constants') }}?lang={{ $lang ?? 'en' }}" 
                style="color:#4f46e5; font-weight: bold; text-decoration: none;">
                {{ $lang == 'sw' ? 'THAMANI' : 'CONSTANTS' }}
            </a>
        @endif
    </div>

    <script>
        function changeLang(lang) {
            window.location.href = "{{ route('home') }}" + "?lang=" + lang;
        }
    </script>

</body>
</html>
