<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Kiswahili Unit Converter')</title>

    <!-- PWA Support -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#007BFF">

    <!-- iOS support -->
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
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

    <!-- Styles -->
    @stack('styles')
</head>
<body>
    @yield('content')

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>

