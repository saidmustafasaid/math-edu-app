<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
  <meta charset="UTF-8">
  <title>{{ $lang == 'sw' ? 'Mifumo ya Hisabati' : 'Mathematical Formulas' }}</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma;
      background: #f9fafb;
      padding: 20px;
      text-align: center;
    }

    h1 {
      color: #4f46e5;
      margin-bottom: 15px;
    }

    .lang-buttons button {
      background: #4f46e5;
      color: white;
      border: none;
      padding: 8px 15px;
      margin: 5px;
      border-radius: 5px;
      cursor: pointer;
    }

    .lang-buttons button:hover {
      background: #4338ca;
    }

    .formula-section {
      background: #fff;
      margin: 20px auto;
      padding: 15px;
      max-width: 800px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      text-align: left;
    }

    .formula-section h2 {
      color: #1e3a8a;
      border-bottom: 2px solid #4f46e5;
      padding-bottom: 5px;
    }

    .notification {
      background: #4f46e5;
      color: white;
      padding: 12px;
      font-size: 16px;
      margin-bottom: 20px;
      border-radius: 5px;
    }

    #bp-web-widget {
      width: 80px !important;
      height: 80px !important;
      bottom: 20px !important;
      right: 20px !important;
    }

    #bp-web-widget svg {
      width: 60px !important;
      height: 60px !important;
    }
  </style>
</head>
<body>

<h1>{{ $lang == 'sw' ? 'Mifumo ya Hisabati' : 'Mathematical Formulas' }}</h1>

<div class="lang-buttons">
  <button onclick="changeLang('en')">English</button>
  <button onclick="changeLang('sw')">Kiswahili</button>
  <button onclick="window.location.href='{{ route('home', ['lang' => $lang]) }}'" style="background-color: #22c55e">
    {{ $lang == 'sw' ? 'Rudi kwenye menyu kuu' : 'Home' }}
  </button>
</div>

<div class="notification">
  {{ $lang == 'sw' 
      ? 'Kwa fomula zaidi, tumia Chatbot wetu kuuliza maswali.' 
      : 'For more formulas, use our Chatbot to ask questions.' }}
</div>

@php
$formulaSources = [
    'Algebra' => [
        'sw' => 'Aljebra',
        'formulas' => ['(a + b)² = a² + 2ab + b²', 'a² - b² = (a + b)(a - b)']
    ],
    'Trigonometry' => [
        'sw' => 'Trigonometri',
        'formulas' => ['sin²A + cos²A = 1', 'sin(2A) = 2sinAcosA']
    ],
    'Calculus' => [
        'sw' => 'Hesabu za Kiwango (Calculus)',
        'formulas' => ['d/dx xⁿ = nxⁿ⁻¹', '∫xⁿ dx = xⁿ⁺¹/(n+1) + C']
    ]
];
@endphp

@foreach($formulaSources as $key => $details)
  <div class="formula-section">
    <h2>{{ $lang == 'sw' ? $details['sw'] : $key }}</h2>
    <ul>
      @foreach($details['formulas'] as $formula)
        <li>{{ $formula }}</li>
      @endforeach
    </ul>
  </div>
@endforeach

<script>
  function changeLang(lang) {
    window.location.href = "{{ route('formulas') }}" + "?lang=" + lang;
  }
</script>

<!-- Botpress Chat Widget with larger icon -->
<script src="https://cdn.botpress.cloud/webchat/v2.3/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/03/18/14/20250318141028-30WRMG85.js"></script>

</body>
</html>
