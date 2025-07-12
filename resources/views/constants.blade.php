<!DOCTYPE html>
<html lang="{{ $lang ?? 'en' }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $lang == 'sw' ? 'Thamani za Hisabati' : 'Mathematical Constants' }}</title>

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
        }
        .top-bar {
            text-align: center;
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .home-button {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }
        .home-button:hover {
            background-color: #1b5e20;
        }
        .lang-button {
            background-color: #1565c0;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .lang-button:hover {
            background-color: #0d47a1;
        }
        .lang-button:disabled {
            background-color: #90caf9;
            color: #0d47a1;
            cursor: not-allowed;
        }
        table {
            width: 90%;
            max-width: 1000px;
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
            text-align: left;
            font-size: 1rem;
        }
        th {
            background-color: #90caf9;
            color: #0d47a1;
            font-weight: 600;
        }
        tr:last-child td {
            border-bottom: none;
        }
        @media (max-width: 600px) {
            body {
                margin: 10px;
            }
            table, th, td {
                font-size: 0.9rem;
            }
            .home-button, .lang-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

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
      .then(function(registration) {
        console.log('Service Worker registered with scope:', registration.scope);
      }).catch(function(error) {
        console.error('Service Worker registration failed:', error);
      });
  }
</script>

<body>

    <h1>{{ $lang == 'sw' ? 'Thamani za Hisabati' : 'Mathematical Constants' }}</h1>

    <div class="top-bar">
        <a href="{{ url('/') }}?lang={{ $lang ?? 'en' }}" class="home-button">
            {{ $lang == 'sw' ? 'Rudi kwenye menyu kuu' : 'Home' }}
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
                <th>{{ $lang == 'sw' ? 'Jina' : 'Name' }}</th>
                <th>{{ $lang == 'sw' ? 'Thamani' : 'Value' }}</th>
                <th>{{ $lang == 'sw' ? 'Maelezo' : 'Description' }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>π (Pi)</td>
                <td>3.14159</td>
                <td>{{ $lang == 'sw' ? 'Uwiano wa mzunguko wa mduara na kipenyo chake' : 'Ratio of the circumference of a circle to its diameter' }}</td>
            </tr>
            <tr>
                <td>e (Euler’s Number)</td>
                <td>2.71828</td>
                <td>{{ $lang == 'sw' ? 'Msingi wa logaritm ya asili' : 'Base of the natural logarithm' }}</td>
            </tr>
            <tr>
                <td>φ (Phi)</td>
                <td>1.61803</td>
                <td>{{ $lang == 'sw' ? 'Uwiano wa dhahabu (golden ratio)' : 'The golden ratio' }}</td>
            </tr>
            <tr>
                <td>γ (Euler-Mascheroni)</td>
                <td>0.57721</td>
                <td>{{ $lang == 'sw' ? 'Thamani ya Euler-Mascheroni' : 'Euler-Mascheroni constant' }}</td>
            </tr>
            <tr>
                <td>√2 (Square root of 2)</td>
                <td>1.41421</td>
                <td>{{ $lang == 'sw' ? 'Urefu wa diagonal ya mraba wa upande mmoja' : 'Length of the diagonal of a unit square' }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
