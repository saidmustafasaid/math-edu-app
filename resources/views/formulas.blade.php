<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $lang == 'sw' ? 'Mifumo ya Hisabati' : 'Mathematical Formulas' }}</title>
  <style>
    /* Reset and base */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f3f4f6;
      margin: 0;
      padding: 20px;
      color: #1e293b;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }
    h1 {
      color: #6366f1; /* Indigo-500 */
      font-weight: 700;
      margin-bottom: 20px;
      font-size: 2.5rem;
      text-align: center;
    }

    /* Container for content */
    .container {
      width: 100%;
      max-width: 900px;
      background: #ffffff;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      box-sizing: border-box;
    }

    /* Language Buttons */
    .lang-buttons {
      display: flex;
      justify-content: center;
      gap: 12px;
      margin-bottom: 25px;
      flex-wrap: wrap;
    }
    .lang-buttons button {
      background-color: #6366f1;
      border: none;
      color: white;
      padding: 10px 22px;
      font-size: 1rem;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      box-shadow: 0 3px 7px rgba(99,102,241,0.5);
      user-select: none;
      flex: 1 0 120px;
      max-width: 150px;
    }
    .lang-buttons button:hover,
    .lang-buttons button:focus {
      background-color: #4f46e5;
      outline: none;
    }
    .lang-buttons .home-btn {
      background-color: #22c55e;
      box-shadow: 0 3px 7px rgba(34,197,94,0.5);
    }
    .lang-buttons .home-btn:hover,
    .lang-buttons .home-btn:focus {
      background-color: #16a34a;
      outline: none;
    }

    /* Notification */
    .notification {
      background-color: #6366f1;
      color: white;
      padding: 14px 20px;
      border-radius: 10px;
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 35px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(99,102,241,0.5);
    }

    /* Formula sections */
    .formula-section {
      margin-bottom: 40px;
      text-align: left;
    }
    .formula-section h2 {
      color: #4338ca;
      font-size: 1.8rem;
      font-weight: 700;
      border-bottom: 3px solid #6366f1;
      padding-bottom: 8px;
      margin-bottom: 15px;
    }
    .formula-section ul {
      list-style-type: none;
      padding-left: 0;
      margin: 0;
    }
    .formula-section li {
      background-color: #eef2ff;
      margin-bottom: 10px;
      padding: 12px 18px;
      font-family: 'Courier New', Courier, monospace;
      font-size: 1.2rem;
      border-radius: 8px;
      box-shadow: inset 0 0 5px rgba(99,102,241,0.2);
      user-select: text;
      transition: background-color 0.3s ease;
      cursor: default;
    }
    .formula-section li:hover {
      background-color: #dbeafe;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }
      .formula-section h2 {
        font-size: 1.4rem;
      }
      .formula-section li {
        font-size: 1rem;
      }
      .lang-buttons button {
        flex: 1 0 100%;
        max-width: 100%;
      }
    }

    /* Botpress Chat Widget Customization */
    #bp-web-widget {
      width: 80px !important;
      height: 80px !important;
      bottom: 20px !important;
      right: 20px !important;
      box-shadow: 0 3px 8px rgba(0,0,0,0.15);
      border-radius: 50%;
      overflow: hidden;
      transition: box-shadow 0.3s ease;
    }
    #bp-web-widget:hover {
      box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }
    #bp-web-widget svg {
      width: 60px !important;
      height: 60px !important;
    }
  </style>
</head>
<body>

  <h1>{{ $lang == 'sw' ? 'Mifumo ya Hisabati' : 'Mathematical Formulas' }}</h1>

  <div class="container">
    <div class="lang-buttons">
      <button onclick="changeLang('en')" aria-label="Switch to English">English</button>
      <button onclick="changeLang('sw')" aria-label="Badilisha lugha kwenda Kiswahili">Kiswahili</button>
      <button onclick="window.location.href='{{ route('home', ['lang' => $lang]) }}'" 
              class="home-btn"
              aria-label="{{ $lang == 'sw' ? 'Rudi kwenye menyu kuu' : 'Go back to Home' }}">
        {{ $lang == 'sw' ? 'Rudi kwenye menyu kuu' : 'Home' }}
      </button>
    </div>

    <div class="notification" role="alert">
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
      <section class="formula-section" aria-labelledby="section-{{ $key }}">
        <h2 id="section-{{ $key }}">{{ $lang == 'sw' ? $details['sw'] : $key }}</h2>
        <ul>
          @foreach($details['formulas'] as $formula)
            <li>{{ $formula }}</li>
          @endforeach
        </ul>
      </section>
    @endforeach
  </div>

  <script>
    function changeLang(lang) {
      window.location.href = "{{ route('formulas') }}" + "?lang=" + lang;
    }
  </script>

  <!-- Botpress Chat Widget -->
  <script src="https://cdn.botpress.cloud/webchat/v2.3/inject.js"></script>
  <script src="https://files.bpcontent.cloud/2025/03/18/14/20250318141028-30WRMG85.js"></script>

</body>
</html>
