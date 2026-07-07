<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Add Question — {{ $test->title }}</h2>
            <a href="{{ route('teacher.tests.show', $test) }}" class="text-gray-600 hover:text-gray-800 text-sm">← Back to Test</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.tests.questions.store', $test) }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="question_text" value="Question" />
                        <textarea id="question_text" name="question_text" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required placeholder="Type your question here...">{{ old('question_text') }}</textarea>
                        <x-input-error :messages="$errors->get('question_text')" class="mt-1" />
                    </div>

                    <div class="space-y-3">
                        <p class="text-sm font-medium text-gray-700">Answer Options <span class="text-gray-400">(A & B required, C & D optional)</span></p>

                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-sm font-bold shrink-0">{{ $opt }}</span>
                            <input type="text" name="option_{{ strtolower($opt) }}" value="{{ old('option_' . strtolower($opt)) }}"
                                placeholder="Option {{ $opt }}{{ in_array($opt, ['A','B']) ? ' (required)' : ' (optional)' }}"
                                {{ in_array($opt, ['A','B']) ? 'required' : '' }}
                                class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                        </div>
                        @if($errors->has('option_' . strtolower($opt)))
                        <x-input-error :messages="$errors->get('option_' . strtolower($opt))" class="ml-11" />
                        @endif
                        @endforeach
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="correct_answer" value="Correct Answer" />
                            <select id="correct_answer" name="correct_answer" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                                <option value="">-- Select --</option>
                                @foreach(['A', 'B', 'C', 'D'] as $opt)
                                <option value="{{ $opt }}" {{ old('correct_answer') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('correct_answer')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="marks" value="Marks for this question" />
                            <x-text-input id="marks" name="marks" type="number" min="1" class="mt-1 block w-full" :value="old('marks', 1)" required />
                            <x-input-error :messages="$errors->get('marks')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Add Question</x-primary-button>
                        <button type="submit" name="add_another" value="1" class="px-4 py-2 bg-green-100 text-green-700 rounded-md hover:bg-green-200 text-sm font-medium">Add & Continue</button>
                        <a href="{{ route('teacher.tests.show', $test) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Done Adding</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
