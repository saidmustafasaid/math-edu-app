<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $lang == 'sw' ? 'UKURASA WA NYUMBANI' : 'HOME PAGE' }}</title>

    <!-- ✅ Google AdSense Auto Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9366093496716678"
        crossorigin="anonymous"></script>

    <!-- ✅ Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VHHX6QYHMN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-VHHX6QYHMN');
    </script>

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Arial Black', Arial, sans-serif;
        }
        @media (min-width: 1024px) {
            .sidebar a {
                width: 1000px;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col items-center px-4">

    <!-- Content Area -->
    <div class="w-full max-w-7xl text-center py-10">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-indigo-600 uppercase mb-6">
            {{ $lang == 'en' ? 'WELCOME TO TANZANIAN STUDENTS APP' : 'KARIBU KWENYE PROGRAMU YA WANAFUNZI WA TANZANIA' }}
        </h1>

        <!-- Language Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-6">
            <button onclick="changeLang('en')" class="bg-indigo-600 hover:bg-indigo-800 text-white font-black py-3 px-6 rounded">
                ENGLISH
            </button>
            <button onclick="changeLang('sw')" class="bg-indigo-600 hover:bg-indigo-800 text-white font-black py-3 px-6 rounded">
                KISWAHILI
            </button>
        </div>

        <p class="text-lg font-semibold mb-8">
            {{ $lang == 'en' ? 'Please select a service from the menu below.' : 'Tafadhali chagua huduma kutoka kwenye menyu hapa chini.' }}
        </p>
    </div>

    <!-- Sidebar Navigation -->
    <div class="sidebar flex flex-col items-center gap-4 w-full max-w-4xl pb-10">
        @php
            $links = [
                ['route' => 'converter', 'en' => 'UNIT CONVERTER', 'sw' => 'KIBADILISHA VITENGO'],
                ['route' => 'calculator', 'en' => 'Scientific Calculator', 'sw' => 'Kikokotoo cha Kisayansi'],
                ['route' => 'formulas', 'en' => 'Mathematical Formulas', 'sw' => 'Mifumo ya Hisabati'],
                ['route' => 'angles', 'en' => 'Angle Values', 'sw' => 'Pembe Maarufu'],
            ];
        @endphp

        @foreach ($links as $link)
            <a href="{{ route($link['route'], ['lang' => $lang]) }}"
               class="block w-full text-center text-indigo-600 font-black uppercase py-4 px-6 rounded hover:bg-indigo-100 transition duration-200 text-lg sm:text-xl md:text-2xl">
                {{ $lang == 'sw' ? $link['sw'] : $link['en'] }}
            </a>
        @endforeach

        <a href="{{ url('constants') }}?lang={{ $lang ?? 'en' }}"
           class="block w-full text-center text-indigo-600 font-black uppercase py-4 px-6 rounded hover:bg-indigo-100 transition duration-200 text-lg sm:text-xl md:text-2xl">
            {{ $lang == 'sw' ? 'THAMANI' : 'CONSTANTS' }}
        </a>
    </div>

    <!-- Language Switch Script -->
    <script>
        function changeLang(lang) {
            window.location.href = "{{ route('home') }}" + "?lang=" + lang;
        }
    </script>

</body>
</html>
