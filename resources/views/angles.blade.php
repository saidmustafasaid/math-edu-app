<!DOCTYPE html>
<html lang="{{ $lang ?? 'en' }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $lang == 'sw' ? 'Thamani za Pembe' : 'Angle Values' }}</title>

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

  <!-- PWA Support -->
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#007BFF">
  <link rel="apple-touch-icon" href="/icons/icon-192.png">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">

  <!-- Service Worker -->
  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/serviceworker.js')
        .then(function(reg) {
          console.log('Service Worker registered:', reg.scope);
        }).catch(function(err) {
          console.error('Service Worker registration failed:', err);
        });
    }
  </script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e3f2fd;
      color: #0d47a1;
      margin: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 700;
      color: #0d47a1;
      font-size: 2.3rem;
    }
    .top-bar {
      text-align: center;
      margin-bottom: 25px;
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .home-button,
    .lang-button {
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .home-button {
      background-color: #2e7d32;
      color: white;
      text-decoration: none;
    }
    .home-button:hover {
      background-color: #1b5e20;
    }
    .lang-button {
      background-color: #1565c0;
      color: white;
    }
    .lang-button:disabled {
      background-color: #90caf9;
      color: #0d47a1;
      font-weight: bold;
      cursor: default;
    }
    table {
      width: 100%;
      max-width: 960px;
      margin: 0 auto;
      border-collapse: collapse;
      box-shadow: 0 0 10px #90caf9;
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #bbdefb;
      text-align: center;
      font-size: 1rem;
    }
    th {
      background-color: #90caf9;
      color: #0d47a1;
      font-weight: 600;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
      body {
        margin: 10px;
        padding: 5px;
      }
      h1 {
        font-size: 1.8rem;
      }
      table {
        font-size: 0.85rem;
        width: 100%;
      }
      th, td {
        padding: 8px 10px;
      }
      .lang-button, .home-button {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
      }
    }

    @media (max-width: 420px) {
      th, td {
        font-size: 0.78rem;
        padding: 6px;
      }
    }
  </style>
</head>

<body>

  <h1>{{ $lang == 'sw' ? 'Thamani za Pembe Maarufu' : 'Common Angle Values' }}</h1>

  <div class="top-bar">
    <a href="{{ url('/') }}?lang={{ $lang ?? 'en' }}" class="home-button">
      {{ $lang == 'sw' ? 'Rudi Kwenye Menyu Kuu' : 'Home' }}
    </a>
    <form method="GET" action="{{ url()->current() }}">
      <input type="hidden" name="lang" value="en">
      <button type="submit" class="lang-button" {{ $lang == 'en' ? 'disabled' : '' }}>English</button>
    </form>
    <form method="GET" action="{{ url()->current() }}">
      <input type="hidden" name="lang" value="sw">
      <button type="submit" class="lang-button" {{ $lang == 'sw' ? 'disabled' : '' }}>Kiswahili</button>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>{{ $lang == 'sw' ? 'Digrii (°)' : 'Degrees (°)' }}</th>
        <th>{{ $lang == 'sw' ? 'Radiansi (rad)' : 'Radians (rad)' }}</th>
        <th>sin(θ)</th>
        <th>cos(θ)</th>
        <th>tan(θ)</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>0°</td><td>0</td><td>0</td><td>1</td><td>0</td></tr>
      <tr><td>30°</td><td>π/6</td><td>1/2</td><td>√3/2</td><td>1/√3</td></tr>
      <tr><td>45°</td><td>π/4</td><td>√2/2</td><td>√2/2</td><td>1</td></tr>
      <tr><td>60°</td><td>π/3</td><td>√3/2</td><td>1/2</td><td>√3</td></tr>
      <tr><td>90°</td><td>π/2</td><td>1</td><td>0</td><td>∞</td></tr>
      <tr><td>120°</td><td>2π/3</td><td>√3/2</td><td>-1/2</td><td>-√3</td></tr>
      <tr><td>135°</td><td>3π/4</td><td>√2/2</td><td>-√2/2</td><td>-1</td></tr>
      <tr><td>150°</td><td>5π/6</td><td>1/2</td><td>-√3/2</td><td>-1/√3</td></tr>
      <tr><td>180°</td><td>π</td><td>0</td><td>-1</td><td>0</td></tr>
      <tr><td>210°</td><td>7π/6</td><td>-1/2</td><td>-√3/2</td><td>1/√3</td></tr>
      <tr><td>225°</td><td>5π/4</td><td>-√2/2</td><td>-√2/2</td><td>1</td></tr>
      <tr><td>240°</td><td>4π/3</td><td>-√3/2</td><td>-1/2</td><td>√3</td></tr>
      <tr><td>270°</td><td>3π/2</td><td>-1</td><td>0</td><td>-∞</td></tr>
      <tr><td>300°</td><td>5π/3</td><td>-√3/2</td><td>1/2</td><td>-√3</td></tr>
      <tr><td>315°</td><td>7π/4</td><td>-√2/2</td><td>√2/2</td><td>-1</td></tr>
      <tr><td>330°</td><td>11π/6</td><td>-1/2</td><td>√3/2</td><td>-1/√3</td></tr>
      <tr><td>360°</td><td>2π</td><td>0</td><td>1</td><td>0</td></tr>
    </tbody>
  </table>

</body>
</html>
