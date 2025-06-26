<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $lang == 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator' }}</title>
    <style>
        body {
            background: #f9fafb;
            font-family: 'Segoe UI', Tahoma;
            padding: 30px;
            text-align: center;
        }
        h1 {
            color: #4f46e5;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .calculator {
            max-width: 400px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .display {
            width: 100%;
            height: 60px;
            text-align: right;
            font-size: 20px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            background: #e2e8f0;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        button {
            padding: 15px 0;
            font-size: 16px;
            background: #4f46e5;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #4338ca;
        }
        .function {
            background: #10b981;
        }
        .function:hover {
            background: #059669;
        }
        .lang-buttons {
            margin-bottom: 15px;
        }
        .lang-buttons button {
            background: #4f46e5;
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
        #home-btn {
            background: green;
            margin-left: 10px;
        }
        #home-btn:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>

<h1 id="title">{{ $lang == 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator' }}</h1>

<div class="lang-buttons">
    <button type="button" onclick="setLang('en')">English</button>
    <button type="button" onclick="setLang('sw')">Kiswahili</button>
    <button type="button" id="home-btn" onclick="goHome()">
        {{ $lang == 'sw' ? 'Rudi kwenye menyu kuu' : 'Home' }}
    </button>
</div>

<div class="calculator">
    <input type="text" id="display" class="display" readonly>

    <div class="grid">
        <button onclick="clearDisplay()">C</button>
        <button onclick="backspace()">⌫</button>
        <button onclick="appendValue('(')">(</button>
        <button onclick="appendValue(')')">)</button>

        <button class="function" onclick="appendValue('Math.sin(')">sin</button>
        <button class="function" onclick="appendValue('Math.cos(')">cos</button>
        <button class="function" onclick="appendValue('Math.tan(')">tan</button>
        <button onclick="appendValue('/')">÷</button>

        <button onclick="appendValue('7')">7</button>
        <button onclick="appendValue('8')">8</button>
        <button onclick="appendValue('9')">9</button>
        <button onclick="appendValue('*')">×</button>

        <button onclick="appendValue('4')">4</button>
        <button onclick="appendValue('5')">5</button>
        <button onclick="appendValue('6')">6</button>
        <button onclick="appendValue('-')">−</button>

        <button onclick="appendValue('1')">1</button>
        <button onclick="appendValue('2')">2</button>
        <button onclick="appendValue('3')">3</button>
        <button onclick="appendValue('+')">+</button>

        <button onclick="appendValue('0')">0</button>
        <button onclick="appendValue('.')">.</button>
        <button onclick="calculate()">=</button>
        <button onclick="toggleSign()">±</button>

        <button class="function" onclick="appendValue('Math.log10(')">log</button>
        <button class="function" onclick="appendValue('Math.log(')">ln</button>
        <button class="function" onclick="appendValue('Math.sqrt(')">√</button>
        <button class="function" onclick="appendValue('Math.pow(')">xʸ</button>

        <button class="function" onclick="appendValue('Math.PI')">π</button>
        <button class="function" onclick="appendValue('Math.E')">e</button>
        <button class="function" onclick="appendValue('%')">mod</button>
        <button class="function" onclick="appendValue('Math.exp(')">exp</button>
    </div>
</div>

<script>
    let lang = "{{ $lang }}";

    function setLang(selectedLang) {
        lang = selectedLang;
        document.getElementById('title').textContent = 
            (lang === 'sw') ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator';
        document.getElementById('home-btn').textContent = 
            (lang === 'sw') ? 'Rudi kwenye menyu kuu' : 'Home';
    }

    function goHome() {
        window.location.href = "{{ route('home') }}" + "?lang=" + lang;
    }

    const display = document.getElementById('display');

    function appendValue(value) {
        display.value += value;
    }

    function clearDisplay() {
        display.value = '';
    }

    function backspace() {
        display.value = display.value.slice(0, -1);
    }

    function calculate() {
        try {
            display.value = eval(display.value);
        } catch {
            display.value = 'Error';
        }
    }

    function toggleSign() {
        if (display.value.startsWith('-')) {
            display.value = display.value.substring(1);
        } else {
            display.value = '-' + display.value;
        }
    }
</script>

</body>
</html>
