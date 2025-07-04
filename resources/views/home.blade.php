<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8" />
    <title>{{ $lang == 'sw' ? 'UKURASA WA NYUMBANI' : 'HOME PAGE' }}</title>
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
        .lang-buttons button {
            background: #4f46e5;
            border: none;
            color: #fff;
            font-weight: 900;
            padding: 12px 28px;
            margin: 0 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.25s;
        }
        .lang-buttons button:hover {
            background: #3b31a1;
        }
        .sidebar {
            width: 100%;
            padding: 25px 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column; /* vertical links */
            align-items: center;
            background: transparent; /* no background color */
        }
        .sidebar a {
            color: #4f46e5; /* change to purple for visibility */
            text-decoration: none;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 8px;
            font-weight: 900;
            text-transform: uppercase;
            transition: background 0.3s ease, color 0.3s ease;
            width: 1000px;
            text-align: center;
        }
        .sidebar a:hover {
            background: #e0e7ff; /* light hover effect */
            color: #1e3a8a;
        }
    </style>
</head>
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
        @endif
    </div>
    

    <script>
        function changeLang(lang) {
            window.location.href = "{{ route('home') }}" + "?lang=" + lang;
        }
    </script>

</body>
</html>
