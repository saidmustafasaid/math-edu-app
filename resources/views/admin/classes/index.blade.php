<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Class Management</h2>
            <a href="{{ route('admin.classes.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 text-sm">+ Create Class</a>
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
                            <th class="px-6 py-3">Class Name</th>
                            <th class="px-6 py-3">Teacher</th>
                            <th class="px-6 py-3">Students</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($classes as $class)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $class->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $class->teacher->name }}</td>
                            <td class="px-6 py-4"><span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-medium">{{ $class->students_count }} students</span></td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('admin.classes.show', $class) }}" class="text-purple-600 hover:underline text-xs">Manage Students</a>
                                <a href="{{ route('admin.classes.edit', $class) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                <form method="POST" action="{{ route('admin.classes.destroy', $class) }}" onsubmit="return confirm('Delete this class?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">No classes yet. Create one!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
