<!DOCTYPE html>
<html lang="{{ $lang ?? 'en' }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $lang == 'sw' ? 'Thamani za Hisabati' : 'Mathematical Constants' }}</title>
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
        }
        .home-button {
            background-color: #2e7d32; /* Green */
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            margin: 0 10px;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .home-button:hover {
            background-color: #1b5e20;
        }
        .lang-button {
            background-color: #1565c0; /* Blue */
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 6px;
            margin: 0 5px;
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
            width: 80%;
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
        }
        th {
            background-color: #90caf9;
            color: #0d47a1;
            font-weight: 600;
        }
        tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>

    <h1>{{ $lang == 'sw' ? 'Thamani za Hisabati' : 'Mathematical Constants' }}</h1>

    <div class="top-bar">
        <!-- ✅ Green Home Button -->
        <a href="{{ url('/') }}?lang={{ $lang ?? 'en' }}" class="home-button">
            {{ $lang == 'sw' ? 'Rudi kwenye menyu kuu' : 'Home' }}
        </a>

        <!-- 🌐 Language Toggle -->
        <form method="GET" action="{{ url()->current() }}" style="display:inline;">
            <input type="hidden" name="lang" value="en">
            <button type="submit" class="lang-button" {{ $lang == 'en' ? 'disabled' : '' }}>English</button>
        </form>
        <form method="GET" action="{{ url()->current() }}" style="display:inline;">
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
