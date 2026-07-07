<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My Assignments</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($assignments->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">No assignments available yet.</div>
            @else
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-left text-gray-600">
                            <th class="px-6 py-3">Assignment</th>
                            <th class="px-6 py-3">Class</th>
                            <th class="px-6 py-3">Subject</th>
                            <th class="px-6 py-3">Due Date</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($assignments as $assignment)
                        @php
                            $isSubmitted = $submittedIds->contains($assignment->id);
                            $isOverdue = $assignment->due_date->isPast() && !$isSubmitted;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $assignment->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $assignment->schoolClass->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $assignment->subject->name ?? '—' }}</td>
                            <td class="px-6 py-4 {{ $isOverdue ? 'text-red-600' : 'text-gray-700' }}">{{ $assignment->due_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($isSubmitted)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Submitted</span>
                                @elseif($isOverdue)
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Overdue</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('student.assignments.show', $assignment) }}" class="text-blue-600 hover:underline text-xs">
                                    {{ $isSubmitted ? 'View Submission' : 'View & Submit' }}
                                </a>
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
