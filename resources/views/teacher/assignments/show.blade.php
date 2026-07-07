<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Assignment: {{ $assignment->title }}</h2>
            <a href="{{ route('teacher.assignments.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">← Back</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            {{-- Details --}}
            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-3 gap-4 text-sm">
                    <div><span class="text-gray-500">Class:</span> <span class="font-medium">{{ $assignment->schoolClass->name }}</span></div>
                    <div><span class="text-gray-500">Due:</span> <span class="font-medium {{ $assignment->due_date->isPast() ? 'text-red-600' : '' }}">{{ $assignment->due_date->format('d M Y H:i') }}</span></div>
                    <div><span class="text-gray-500">Max Marks:</span> <span class="font-medium">{{ $assignment->max_marks }}</span></div>
                </div>
                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $assignment->description }}</p>
                </div>
            </div>

            {{-- Submissions --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Submissions ({{ $assignment->submissions->count() }})</h3>

                @forelse($assignment->submissions as $submission)
                <div class="border rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $submission->student->name }}</p>
                            <p class="text-xs text-gray-500">Submitted: {{ $submission->submitted_at?->format('d M Y H:i') ?? 'Not yet' }}</p>
                        </div>
                        @if($submission->grade !== null)
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $submission->grade }} / {{ $assignment->max_marks }}
                        </span>
                        @else
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">Pending Grade</span>
                        @endif
                    </div>

                    @if($submission->content)
                    <div class="mt-3 p-3 bg-gray-50 rounded text-sm text-gray-700 whitespace-pre-wrap max-h-32 overflow-y-auto">{{ $submission->content }}</div>
                    @endif

                    @if($submission->feedback)
                    <div class="mt-2 p-3 bg-blue-50 rounded text-sm text-blue-700"><strong>Feedback:</strong> {{ $submission->feedback }}</div>
                    @endif

                    {{-- Grade Form --}}
                    <form method="POST" action="{{ route('teacher.assignments.grade', $submission) }}" class="mt-3 flex gap-3 items-end">
                        @csrf
                        <div>
                            <label class="text-xs text-gray-500">Grade (0–{{ $assignment->max_marks }})</label>
                            <input type="number" name="grade" min="0" max="{{ $assignment->max_marks }}" value="{{ $submission->grade }}"
                                class="block mt-1 w-24 border-gray-300 rounded-md shadow-sm text-sm">
                        </div>
                        <div class="flex-1">
                            <label class="text-xs text-gray-500">Feedback (optional)</label>
                            <input type="text" name="feedback" value="{{ $submission->feedback }}" placeholder="Well done! or Needs improvement..."
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm text-sm">
                        </div>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm">Save Grade</button>
                    </form>
                </div>
                @empty
                <p class="text-gray-400 text-center py-4">No submissions yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
