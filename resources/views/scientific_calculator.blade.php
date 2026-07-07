<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $lang == 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator' }}</title>

    <!-- Google AdSense Auto Ads -->
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

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- PWA Support -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f172a">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <script>
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js')
          .then(r => console.log('SW registered:', r.scope))
          .catch(e => console.error('SW failed:', e));
      }
    </script>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px 40px;
        }

        /* ── Header ── */
        .page-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            width: 100%;
            max-width: 420px;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        h1 {
            color: #f1f5f9;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        /* ── Language + Home bar ── */
        .lang-bar {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 420px;
        }

        .lang-bar button {
            flex: 1;
            padding: 9px 0;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            background: rgba(255,255,255,0.07);
            color: #cbd5e1;
            letter-spacing: 0.3px;
        }

        .lang-bar button:hover { background: rgba(255,255,255,0.14); color: #f1f5f9; }
        .lang-bar button:active { transform: scale(0.96); }

        #home-btn {
            background: rgba(16,185,129,0.2) !important;
            border-color: rgba(16,185,129,0.4) !important;
            color: #6ee7b7 !important;
        }
        #home-btn:hover { background: rgba(16,185,129,0.32) !important; color: #a7f3d0 !important; }

        /* ── Calculator shell ── */
        .calculator {
            width: 100%;
            max-width: 420px;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 20px;
            box-shadow:
                0 25px 60px rgba(0,0,0,0.5),
                inset 0 1px 0 rgba(255,255,255,0.1);
        }

        /* ── Display ── */
        .display-wrapper {
            background: rgba(0,0,0,0.35);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 14px 16px 12px;
            margin-bottom: 18px;
            text-align: right;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #expression {
            font-size: 13px;
            color: #64748b;
            min-height: 18px;
            word-break: break-all;
            letter-spacing: 0.5px;
        }

        #display {
            width: 100%;
            border: none;
            background: transparent;
            text-align: right;
            font-size: 32px;
            font-weight: 300;
            color: #f8fafc;
            outline: none;
            cursor: default;
            letter-spacing: -0.5px;
            caret-color: transparent;
            padding: 0;
        }

        #display::selection { background: transparent; }

        /* ── Button grid ── */
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        button {
            padding: 0;
            height: 56px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.12s, transform 0.08s, box-shadow 0.12s;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.2px;
        }

        button::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0);
            transition: background 0.12s;
        }

        button:hover::after { background: rgba(255,255,255,0.08); }
        button:active { transform: scale(0.94); }
        button:active::after { background: rgba(0,0,0,0.15); }

        /* Number buttons */
        .btn-num {
            background: rgba(255,255,255,0.1);
            color: #f1f5f9;
            border: 1px solid rgba(255,255,255,0.07);
        }

        /* Operator buttons */
        .btn-op {
            background: rgba(99,102,241,0.3);
            color: #a5b4fc;
            border: 1px solid rgba(99,102,241,0.25);
        }
        .btn-op:hover::after { background: rgba(255,255,255,0.12); }

        /* Function buttons */
        .btn-fn {
            background: rgba(20,184,166,0.2);
            color: #5eead4;
            border: 1px solid rgba(20,184,166,0.2);
            font-size: 13px;
        }

        /* Clear / backspace */
        .btn-clear {
            background: rgba(239,68,68,0.25);
            color: #fca5a5;
            border: 1px solid rgba(239,68,68,0.2);
        }

        .btn-back {
            background: rgba(245,158,11,0.2);
            color: #fcd34d;
            border: 1px solid rgba(245,158,11,0.15);
        }

        /* Equals */
        .btn-eq {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(99,102,241,0.4);
        }
        .btn-eq:hover::after { background: rgba(255,255,255,0.12); }

        /* ── Mobile ── */
        @media (max-width: 480px) {
            body { padding: 16px 12px 32px; }
            h1 { font-size: 18px; }
            .calculator { padding: 14px; }
            #display { font-size: 26px; }
            .grid { gap: 7px; }
            button { height: 50px; font-size: 14px; border-radius: 8px; }
            .btn-fn { font-size: 12px; }
        }
    </style>
</head>
<body>

<div class="page-header">
    <div class="header-icon">🧮</div>
    <h1 id="title">{{ $lang == 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator' }}</h1>
</div>

<div class="lang-bar">
    <button type="button" onclick="setLang('en')">English</button>
    <button type="button" onclick="setLang('sw')">Kiswahili</button>
    <button type="button" id="home-btn" onclick="goHome()">
        {{ $lang == 'sw' ? 'Rudi Nyumbani' : 'Home' }}
    </button>
</div>

<div class="calculator">
    <div class="display-wrapper">
        <div id="expression"></div>
        <input type="text" id="display" readonly placeholder="0">
    </div>

    <div class="grid">
        <!-- Row 1: clear, back, parens, divide -->
        <button class="btn-clear" onclick="clearDisplay()">C</button>
        <button class="btn-back"  onclick="backspace()">⌫</button>
        <button class="btn-fn"    onclick="appendValue('(')">(</button>
        <button class="btn-fn"    onclick="appendValue(')')">)</button>

        <!-- Row 2: trig, divide -->
        <button class="btn-fn" onclick="appendValue('Math.sin(')">sin</button>
        <button class="btn-fn" onclick="appendValue('Math.cos(')">cos</button>
        <button class="btn-fn" onclick="appendValue('Math.tan(')">tan</button>
        <button class="btn-op" onclick="appendValue('/')">÷</button>

        <!-- Row 3: 7 8 9 × -->
        <button class="btn-num" onclick="appendValue('7')">7</button>
        <button class="btn-num" onclick="appendValue('8')">8</button>
        <button class="btn-num" onclick="appendValue('9')">9</button>
        <button class="btn-op"  onclick="appendValue('*')">×</button>

        <!-- Row 4: 4 5 6 − -->
        <button class="btn-num" onclick="appendValue('4')">4</button>
        <button class="btn-num" onclick="appendValue('5')">5</button>
        <button class="btn-num" onclick="appendValue('6')">6</button>
        <button class="btn-op"  onclick="appendValue('-')">−</button>

        <!-- Row 5: 1 2 3 + -->
        <button class="btn-num" onclick="appendValue('1')">1</button>
        <button class="btn-num" onclick="appendValue('2')">2</button>
        <button class="btn-num" onclick="appendValue('3')">3</button>
        <button class="btn-op"  onclick="appendValue('+')">+</button>

        <!-- Row 6: 0 . = ± -->
        <button class="btn-num" onclick="appendValue('0')">0</button>
        <button class="btn-num" onclick="appendValue('.')">.</button>
        <button class="btn-eq"  onclick="calculate()">=</button>
        <button class="btn-op"  onclick="toggleSign()">±</button>

        <!-- Row 7: log ln √ xʸ -->
        <button class="btn-fn" onclick="appendValue('Math.log10(')">log</button>
        <button class="btn-fn" onclick="appendValue('Math.log(')">ln</button>
        <button class="btn-fn" onclick="appendValue('Math.sqrt(')">√</button>
        <button class="btn-fn" onclick="appendValue('Math.pow(')">xʸ</button>

        <!-- Row 8: π e mod exp -->
        <button class="btn-fn" onclick="appendValue('Math.PI')">π</button>
        <button class="btn-fn" onclick="appendValue('Math.E')">e</button>
        <button class="btn-fn" onclick="appendValue('%')">mod</button>
        <button class="btn-fn" onclick="appendValue('Math.exp(')">exp</button>
    </div>
</div>

<script>
    let lang = "{{ $lang }}";
    const display    = document.getElementById('display');
    const expression = document.getElementById('expression');

    function setLang(selectedLang) {
        lang = selectedLang;
        document.getElementById('title').textContent =
            lang === 'sw' ? 'Kikokotoo cha Kisayansi' : 'Scientific Calculator';
        document.getElementById('home-btn').textContent =
            lang === 'sw' ? 'Rudi Nyumbani' : 'Home';
    }

    function goHome() {
        window.location.href = "{{ route('home') }}" + "?lang=" + lang;
    }

    function appendValue(value) {
        display.value += value;
    }

    function clearDisplay() {
        display.value = '';
        expression.textContent = '';
    }

    function backspace() {
        display.value = display.value.slice(0, -1);
    }

    function calculate() {
        try {
            const expr = display.value;
            const result = eval(expr);
            expression.textContent = expr + ' =';
            display.value = result;
        } catch {
            expression.textContent = '';
            display.value = 'Error';
        }
    }

    function toggleSign() {
        if (display.value.startsWith('-')) {
            display.value = display.value.substring(1);
        } else if (display.value) {
            display.value = '-' + display.value;
        }
    }

    // Keyboard support
    document.addEventListener('keydown', e => {
        const key = e.key;
        if (key >= '0' && key <= '9') appendValue(key);
        else if (['+', '-', '*', '/', '(', ')', '.', '%'].includes(key)) appendValue(key);
        else if (key === 'Enter' || key === '=') calculate();
        else if (key === 'Backspace') backspace();
        else if (key === 'Escape') clearDisplay();
    });
</script>

</body>
</html>
