<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">{{ $test->title }}</h2>
            <div id="timer" class="bg-green-600 text-white px-4 py-2 rounded-lg font-mono text-lg font-bold">
                {{ sprintf('%02d:%02d', intdiv($test->duration_minutes, 60) * 60 + $test->duration_minutes % 60, 0) }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6 text-sm text-yellow-800">
                <strong>Instructions:</strong> This test has {{ $test->questions->count() }} questions worth {{ $test->questions->sum('marks') }} marks total.
                You have <strong>{{ $test->duration_minutes }} minutes</strong>. The test will auto-submit when time runs out.
                {{ $test->description ? $test->description : '' }}
            </div>

            <form method="POST" action="{{ route('student.tests.submit', $test) }}" id="testForm">
                @csrf

                @foreach($test->questions as $i => $question)
                <div class="bg-white shadow rounded-lg p-6 mb-4">
                    <div class="flex justify-between items-start mb-4">
                        <p class="font-semibold text-gray-800">{{ $i+1 }}. {{ $question->question_text }}</p>
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs shrink-0 ml-3">{{ $question->marks }} mark{{ $question->marks > 1 ? 's' : '' }}</span>
                    </div>

                    <div class="space-y-2">
                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                        @php $val = 'option_' . strtolower($opt); @endphp
                        @if($question->$val)
                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-green-50 hover:border-green-300 transition has-[:checked]:bg-green-50 has-[:checked]:border-green-400">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $opt }}" class="text-green-600">
                            <span class="w-7 h-7 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-sm font-bold shrink-0">{{ $opt }}</span>
                            <span class="text-gray-800">{{ $question->$val }}</span>
                        </label>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <p class="text-gray-600 mb-4 text-sm">Make sure you have answered all questions before submitting.</p>
                    <button type="submit" onclick="return confirm('Submit test? You cannot change your answers after submitting.')"
                        class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 font-semibold text-lg">
                        Submit Test
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    (function() {
        const totalSeconds = {{ $test->duration_minutes * 60 }};
        const startedAt = {{ $attempt->started_at ? 'new Date("'.$attempt->started_at->toISOString().'").getTime()' : 'Date.now()' }};
        const endTime = startedAt + (totalSeconds * 1000);

        function updateTimer() {
            const remaining = Math.max(0, Math.floor((endTime - Date.now()) / 1000));
            const mins = Math.floor(remaining / 60);
            const secs = remaining % 60;
            const display = (mins < 10 ? '0' : '') + mins + ':' + (secs < 10 ? '0' : '') + secs;
            document.getElementById('timer').textContent = display;

            if (remaining <= 60) document.getElementById('timer').classList.replace('bg-green-600', 'bg-red-600');
            if (remaining <= 0) document.getElementById('testForm').submit();
        }

        updateTimer();
        setInterval(updateTimer, 1000);
    })();
    </script>
</x-app-layout>
