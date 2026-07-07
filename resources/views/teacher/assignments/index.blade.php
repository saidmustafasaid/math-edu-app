<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">My Assignments</h2>
            <a href="{{ route('teacher.assignments.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 text-sm">+ Create Assignment</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-left text-gray-600">
                            <th class="px-6 py-3">Title</th>
                            <th class="px-6 py-3">Class</th>
                            <th class="px-6 py-3">Due Date</th>
                            <th class="px-6 py-3">Submissions</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($assignments as $assignment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $assignment->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $assignment->schoolClass->name }}</td>
                            <td class="px-6 py-4">
                                <span class="{{ $assignment->due_date->isPast() ? 'text-red-600' : 'text-gray-700' }}">
                                    {{ $assignment->due_date->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">{{ $assignment->submissions_count }}</span></td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('teacher.assignments.show', $assignment) }}" class="text-purple-600 hover:underline text-xs">Grade</a>
                                <a href="{{ route('teacher.assignments.edit', $assignment) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                <form method="POST" action="{{ route('teacher.assignments.destroy', $assignment) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">No assignments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
