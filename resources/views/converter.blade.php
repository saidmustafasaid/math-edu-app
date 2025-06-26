<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8" />
    <title>Unit Converter</title>
    <style>
        body { background:white; font-family: 'Segoe UI', Tahoma; text-align:center; padding:30px; }
        h1 { color:#4f46e5; font-size:28px; margin-bottom:20px; }
        label { display:block; margin:10px 0 5px; color:#1f2937; font-weight:bold; font-size:14px; text-align:left; }
        select, input[type="number"] { padding:6px; margin-bottom:15px; border:1px solid #cbd5e1; border-radius:4px; width:100%; box-sizing:border-box; }
        button { background:#4f46e5; color:#fff; padding:8px 20px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; margin-top:10px; }
        button:hover { background:#4338ca; }
        .converter-row { display:flex; justify-content:space-between; gap:15px; max-width:700px; margin:auto; text-align:left; }
        .converter-group { flex:1; min-width:150px; display:flex; flex-direction:column; }
        .alert-danger { color:red; background:#fee2e2; padding:10px; border-radius:5px; margin-bottom:15px; }
        #result-display { color:#16a34a; font-size:20px; margin-top:20px; }
        .action-buttons { margin-top:20px; display:flex; justify-content:center; gap:10px; }
        /* make only the “Home” / “Nyumbani” button green */
        #btn-home {
        background-color: green;
        }

        #btn-home:hover {
        background-color: darkgreen;
        }
    </style>
</head>
<body>
    <h1 id="title">{{ $lang=='sw'?'Kibadilisha Vitengo':'Unit Converter' }}</h1>
    <div>
        <button type="button" id="lang-en">English</button>
        <button type="button" id="lang-sw">Kiswahili</button>
    </div>

    <form method="POST" action="{{ route('convert') }}">
        @csrf
        <input type="hidden" name="lang" id="lang-input" value="{{ $lang }}">

        @if($errors->any())
            <div class="alert-danger">
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        @php
            $defaultCategory = old('category',    $category ?? 'length');
            $defaultValue    = old('value',       $value    ?? '');
            $defaultFrom     = old('from_unit',   $from     ?? '');
            $defaultTo       = old('to_unit',     $to       ?? '');
            $defaultResult   = session('result');
        @endphp

        <div class="converter-row">
            <div class="converter-group">
                <label id="label-category">{{ $translations[$lang]['labelCategory'] }}</label>
                <select name="category" id="category" required>
                    @foreach($units as $cat=>$list)
                        <option value="{{ $cat }}" {{ $defaultCategory==$cat?'selected':'' }}>
                            {{ $categoryLabels[$lang][$cat] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="converter-group">
                <label id="label-value">{{ $translations[$lang]['labelValue'] }}</label>
                <input type="number" name="value" id="value" value="{{ $defaultValue }}" required>
            </div>
            <div class="converter-group">
                <label id="label-from">{{ $translations[$lang]['labelFrom'] }}</label>
                <select name="from_unit" id="from_unit" required></select>
            </div>
            <div class="converter-group">
                <label id="label-to">{{ $translations[$lang]['labelTo'] }}</label>
                <select name="to_unit" id="to_unit" required></select>
            </div>
        </div>

        <div class="action-buttons">
            <button type="submit" id="btn-convert">{{ $translations[$lang]['btnConvert'] }}</button>
            <button type="button" id="new-conversion">{{ $translations[$lang]['btnNewConversion'] }}</button>
            <button type="button" id="btn-home" onclick="window.location.href='{{ route('home',['lang'=>$lang]) }}'">
                {{ $lang=='sw'?'Rudi kwenye menyu kuu':'Home' }}
            </button>
        </div>
    </form>

    @if(!is_null($defaultResult))
        <h2 id="result-display">
            <span id="result-prefix">{{ $translations[$lang]['resultPrefix'] }}</span>
            <span id="result-value">{{ $defaultResult }}</span>
            <span id="result-unit">{{ $translations[$lang]['units'][$defaultTo] ?? $defaultTo }}</span>
        </h2>
    @endif

    <script>
    const translations   = @json($translations),
          units          = @json($units),
          categoryLabels = @json($categoryLabels);
    let   lang           = "{{ $lang }}",
          defaultFrom    = "{{ $defaultFrom }}",
          defaultTo      = "{{ $defaultTo }}",
          defaultResult  = {!! json_encode($defaultResult) !!};

    function setLang(l) {
        lang = l;
        document.getElementById('lang-input').value = l;
        document.getElementById('title').textContent          = l==='sw'?'Kibadilisha Vitengo':'Unit Converter';
        document.getElementById('label-category').textContent = translations[l]['labelCategory'];
        document.getElementById('label-value').textContent    = translations[l]['labelValue'];
        document.getElementById('label-from').textContent     = translations[l]['labelFrom'];
        document.getElementById('label-to').textContent       = translations[l]['labelTo'];
        document.getElementById('btn-convert').textContent    = translations[l]['btnConvert'];
        document.getElementById('new-conversion').textContent = translations[l]['btnNewConversion'];
        document.getElementById('btn-home').textContent        = l==='sw'?'Rudi kwenye menyu kuu':'Home';

        const cat = document.getElementById('category');
        [...cat.options].forEach(opt=> opt.text = categoryLabels[l][opt.value] );

        populateUnits(cat.value);

        ['from_unit','to_unit'].forEach(id=>{
            const sel = document.getElementById(id);
            [...sel.options].forEach(o=>{
                o.text = translations[l]['units'][o.value] ?? o.value;
            });
        });

        if (defaultResult!==null) {
            document.getElementById('result-prefix').textContent = translations[l]['resultPrefix'];
            document.getElementById('result-unit').textContent   =
                translations[l]['units'][document.getElementById('to_unit').value] 
                ?? document.getElementById('to_unit').value;
        }
    }

    function populateUnits(category){
      const f=document.getElementById('from_unit'),
            t=document.getElementById('to_unit');
      f.innerHTML=t.innerHTML='';
      (units[category]||[]).forEach(u=>{
        const txt = translations[lang]['units'][u] ?? u;
        f.add(new Option(txt,u));
        t.add(new Option(txt,u));
      });
      f.value = defaultFrom || units[category][0];
      t.value = defaultTo   || units[category][0];
    }

    document.getElementById('category').addEventListener('change', e=>{
      populateUnits(e.target.value);
      document.getElementById('result-display')?.remove();
    });
    document.getElementById('new-conversion').addEventListener('click',()=>{
      document.getElementById('value').value='';
      document.getElementById('result-display')?.remove();
    });
    document.getElementById('lang-en').addEventListener('click',()=>setLang('en'));
    document.getElementById('lang-sw').addEventListener('click',()=>setLang('sw'));

    setLang(lang);
    populateUnits(document.getElementById('category').value);
    </script>
</body>
</html>
