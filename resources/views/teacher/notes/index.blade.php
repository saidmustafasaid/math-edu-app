<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">My Notes</h2>
            <a href="{{ route('teacher.notes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">+ Post Note</a>
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
                            <th class="px-6 py-3">Subject</th>
                            <th class="px-6 py-3">Posted</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($notes as $note)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $note->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $note->schoolClass->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $note->subject->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $note->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('teacher.notes.edit', $note) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                <form method="POST" action="{{ route('teacher.notes.destroy', $note) }}" onsubmit="return confirm('Delete this note?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">No notes yet. Post your first note!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
