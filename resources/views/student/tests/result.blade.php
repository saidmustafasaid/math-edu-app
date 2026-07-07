<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Test Result: {{ $attempt->test->title }}</h2>
            <a href="{{ route('student.tests') }}" class="text-gray-600 hover:text-gray-800 text-sm">← Back to Tests</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Score Card --}}
            @php $percentage = $attempt->total_marks > 0 ? round(($attempt->score / $attempt->total_marks) * 100) : 0; @endphp
            <div class="bg-white shadow rounded-lg p-8 text-center">
                <div class="w-32 h-32 rounded-full mx-auto flex items-center justify-center text-4xl font-bold mb-4
                    {{ $percentage >= 75 ? 'bg-green-100 text-green-700' : ($percentage >= 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                    {{ $percentage }}%
                </div>
                <p class="text-2xl font-bold text-gray-800">{{ $attempt->score }} / {{ $attempt->total_marks }}</p>
                <p class="text-gray-500 mt-1">
                    @if($percentage >= 75) Excellent work! @elseif($percentage >= 50) Good effort! Keep studying. @else Keep practicing, you can do better! @endif
                </p>
                <p class="text-xs text-gray-400 mt-2">Submitted: {{ $attempt->submitted_at->format('d M Y H:i') }}</p>
            </div>

            {{-- Question Review --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Question Review</h3>

                @foreach($attempt->answers as $i => $answer)
                <div class="border rounded-lg p-4 mb-3 {{ $answer->is_correct ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                    <div class="flex justify-between items-start">
                        <p class="font-medium text-gray-800">{{ $i+1 }}. {{ $answer->question->question_text }}</p>
                        @if($answer->is_correct)
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs shrink-0 ml-2">Correct +{{ $answer->question->marks }}</span>
                        @else
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs shrink-0 ml-2">Wrong</span>
                        @endif
                    </div>
                    <div class="mt-2 text-sm space-y-1">
                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                        @php $val = 'option_' . strtolower($opt); @endphp
                        @if($answer->question->$val)
                        <div class="flex items-center gap-2
                            {{ $opt === $answer->question->correct_answer ? 'text-green-700 font-semibold' : '' }}
                            {{ $opt === $answer->answer && !$answer->is_correct ? 'text-red-600' : '' }}">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold
                                {{ $opt === $answer->question->correct_answer ? 'bg-green-500 text-white' : ($opt === $answer->answer ? 'bg-red-400 text-white' : 'bg-gray-200 text-gray-500') }}">{{ $opt }}</span>
                            {{ $answer->question->$val }}
                            @if($opt === $answer->question->correct_answer)<span class="text-xs">(correct)</span>@endif
                            @if($opt === $answer->answer && !$answer->is_correct)<span class="text-xs">(your answer)</span>@endif
                        </div>
                        @endif
                        @endforeach
                        @if(!$answer->answer)<p class="text-gray-400 text-xs italic">No answer given</p>@endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex gap-3">
                <a href="{{ route('student.tests') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Back to Tests</a>
                <a href="{{ route('student.dashboard') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200">Dashboard</a>
            </div>

        </div>
    </div>
</x-app-layout>
