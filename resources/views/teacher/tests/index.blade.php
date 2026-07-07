<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">My Tests</h2>
            <a href="{{ route('teacher.tests.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm">+ Create Test</a>
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
                            <th class="px-6 py-3">Duration</th>
                            <th class="px-6 py-3">Questions</th>
                            <th class="px-6 py-3">Attempts</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tests as $test)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $test->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $test->schoolClass->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $test->duration_minutes }} min</td>
                            <td class="px-6 py-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">{{ $test->questions_count }} Qs</span></td>
                            <td class="px-6 py-4"><span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ $test->attempts_count }}</span></td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('teacher.tests.show', $test) }}" class="text-green-600 hover:underline text-xs">View/Edit Qs</a>
                                <a href="{{ route('teacher.tests.edit', $test) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                <form method="POST" action="{{ route('teacher.tests.destroy', $test) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">No tests yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
