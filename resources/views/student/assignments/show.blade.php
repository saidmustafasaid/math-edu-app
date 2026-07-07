<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">{{ $assignment->title }}</h2>
            <a href="{{ route('student.assignments') }}" class="text-gray-600 hover:text-gray-800 text-sm">← Back</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            {{-- Assignment Details --}}
            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                    <div><p class="text-gray-500">Class</p><p class="font-medium">{{ $assignment->schoolClass->name }}</p></div>
                    <div><p class="text-gray-500">Subject</p><p class="font-medium">{{ $assignment->subject->name ?? '—' }}</p></div>
                    <div><p class="text-gray-500">Due Date</p><p class="font-medium {{ $assignment->due_date->isPast() ? 'text-red-600' : '' }}">{{ $assignment->due_date->format('d M Y H:i') }}</p></div>
                    <div><p class="text-gray-500">Max Marks</p><p class="font-medium">{{ $assignment->max_marks }}</p></div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-700 mb-2">Instructions:</p>
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $assignment->description }}</p>
                </div>
            </div>

            {{-- Grade / Feedback --}}
            @if($submission && $submission->grade !== null)
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h3 class="font-semibold text-green-800 mb-2">Your Grade</h3>
                <p class="text-3xl font-bold text-green-700">{{ $submission->grade }} / {{ $assignment->max_marks }}</p>
                <p class="text-sm text-green-600 mt-1">({{ round(($submission->grade / $assignment->max_marks) * 100) }}%)</p>
                @if($submission->feedback)
                <div class="mt-3 p-3 bg-white rounded border border-green-200">
                    <p class="text-sm text-gray-700"><strong>Teacher feedback:</strong> {{ $submission->feedback }}</p>
                </div>
                @endif
            </div>
            @endif

            {{-- Submission --}}
            @if($submission)
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-3">Your Submission <span class="text-xs text-gray-400">(submitted {{ $submission->submitted_at?->format('d M Y H:i') }})</span></h3>
                <div class="bg-blue-50 p-4 rounded-lg text-sm text-gray-700 whitespace-pre-wrap">{{ $submission->content }}</div>

                @if(!$assignment->due_date->isPast())
                <p class="text-xs text-gray-400 mt-2">You can update your submission before the due date.</p>
                @endif
            </div>
            @endif

            {{-- Submit / Update Form --}}
            @if(!$assignment->due_date->isPast() || !$submission)
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-3">{{ $submission ? 'Update Your Answer' : 'Submit Your Answer' }}</h3>
                <form method="POST" action="{{ route('student.assignments.submit', $assignment) }}">
                    @csrf
                    <textarea name="content" rows="8" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required
                        placeholder="Write your answer here...">{{ old('content', $submission?->content) }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-1" />
                    <div class="mt-3">
                        <x-primary-button>{{ $submission ? 'Update Submission' : 'Submit Assignment' }}</x-primary-button>
                    </div>
                </form>
            </div>
            @elseif(!$submission)
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-red-700 text-sm">
                This assignment is past due and cannot be submitted.
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
