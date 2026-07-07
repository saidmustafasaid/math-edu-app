<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Test: {{ $test->title }}</h2>
            <a href="{{ route('teacher.tests.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">← Back</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            {{-- Test Details --}}
            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-3 gap-4 text-sm mb-3">
                    <div><span class="text-gray-500">Class:</span> <strong>{{ $test->schoolClass->name }}</strong></div>
                    <div><span class="text-gray-500">Duration:</span> <strong>{{ $test->duration_minutes }} minutes</strong></div>
                    <div><span class="text-gray-500">Questions:</span> <strong>{{ $test->questions->count() }}</strong></div>
                </div>
                @if($test->start_time)
                <p class="text-sm text-gray-500">Available: {{ $test->start_time->format('d M Y H:i') }} → {{ $test->end_time?->format('d M Y H:i') ?? 'Open' }}</p>
                @endif
                <div class="mt-3 flex gap-3">
                    <a href="{{ route('teacher.tests.questions.create', $test) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm">+ Add Question</a>
                    <a href="{{ route('teacher.tests.edit', $test) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-sm">Edit Test</a>
                </div>
            </div>

            {{-- Questions --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Questions ({{ $test->questions->count() }})</h3>
                @forelse($test->questions as $i => $question)
                <div class="border rounded-lg p-4 mb-3">
                    <div class="flex justify-between items-start">
                        <p class="font-medium text-gray-800">{{ $i+1 }}. {{ $question->question_text }}</p>
                        <div class="flex gap-2 ml-3 shrink-0">
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">{{ $question->marks }} mark{{ $question->marks > 1 ? 's' : '' }}</span>
                            <form method="POST" action="{{ route('teacher.tests.questions.destroy', [$test, $question]) }}" onsubmit="return confirm('Delete question?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 text-xs">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-2 grid grid-cols-2 gap-2 text-sm">
                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                        @php $val = 'option_' . strtolower($opt); @endphp
                        @if($question->$val)
                        <div class="flex items-center gap-2 {{ $question->correct_answer === $opt ? 'text-green-700 font-semibold' : 'text-gray-600' }}">
                            <span class="w-6 h-6 rounded-full {{ $question->correct_answer === $opt ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center text-xs font-bold">{{ $opt }}</span>
                            {{ $question->$val }}
                            @if($question->correct_answer === $opt)<span class="text-xs">(correct)</span>@endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="text-center py-6">
                    <p class="text-gray-400 mb-3">No questions yet.</p>
                    <a href="{{ route('teacher.tests.questions.create', $test) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm">Add First Question</a>
                </div>
                @endforelse
            </div>

            {{-- Attempts --}}
            @if($test->attempts->count())
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Student Attempts ({{ $test->attempts->count() }})</h3>
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-left text-gray-500">
                            <th class="px-4 py-2">Student</th>
                            <th class="px-4 py-2">Score</th>
                            <th class="px-4 py-2">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($test->attempts as $attempt)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $attempt->student->name }}</td>
                            <td class="px-4 py-3">
                                @if($attempt->submitted_at)
                                <span class="font-semibold {{ ($attempt->score / max($attempt->total_marks, 1)) >= 0.5 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $attempt->score }} / {{ $attempt->total_marks }}
                                    ({{ round(($attempt->score / max($attempt->total_marks, 1)) * 100) }}%)
                                </span>
                                @else
                                <span class="text-yellow-600 text-xs">In progress</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-500 text-xs">{{ $attempt->submitted_at?->format('d M Y H:i') ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
