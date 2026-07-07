<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tests & Quizzes</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($tests->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">No tests available in your classes yet.</div>
            @else
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-left text-gray-600">
                            <th class="px-6 py-3">Test</th>
                            <th class="px-6 py-3">Class</th>
                            <th class="px-6 py-3">Duration</th>
                            <th class="px-6 py-3">Questions</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($tests as $test)
                        @php $isCompleted = $completedIds->contains($test->id); @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $test->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $test->schoolClass->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $test->duration_minutes }} min</td>
                            <td class="px-6 py-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">{{ $test->questions_count }} Qs</span></td>
                            <td class="px-6 py-4">
                                @if($isCompleted)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Completed</span>
                                @elseif($test->end_time && $test->end_time->isPast())
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">Closed</span>
                                @elseif($test->start_time && $test->start_time->isFuture())
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Not started</span>
                                @else
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">Available</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($isCompleted)
                                @php $attempt = auth()->user()->testAttempts()->where('test_id', $test->id)->whereNotNull('submitted_at')->first(); @endphp
                                @if($attempt)
                                <a href="{{ route('student.tests.result', $attempt) }}" class="text-green-600 hover:underline text-xs">View Result</a>
                                @endif
                                @elseif(!($test->end_time && $test->end_time->isPast()) && !($test->start_time && $test->start_time->isFuture()))
                                <a href="{{ route('student.tests.start', $test) }}" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">Start Test</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
