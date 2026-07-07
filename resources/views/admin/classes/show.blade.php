<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Class: {{ $schoolClass->name }}</h2>
            <a href="{{ route('admin.classes.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">← Back to Classes</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            {{-- Class Info --}}
            <div class="bg-white shadow rounded-lg p-6">
                <p class="text-gray-600"><span class="font-medium">Teacher:</span> {{ $schoolClass->teacher->name }}</p>
                @if($schoolClass->description)
                <p class="text-gray-600 mt-1"><span class="font-medium">Description:</span> {{ $schoolClass->description }}</p>
                @endif
            </div>

            {{-- Add Student --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Enroll Student</h3>
                <form method="POST" action="{{ route('admin.classes.enroll', $schoolClass) }}" class="flex gap-3">
                    @csrf
                    <select name="student_id" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            @if(!$enrolledIds->contains($student->id))
                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 text-sm">Enroll</button>
                </form>
            </div>

            {{-- Enrolled Students --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Enrolled Students ({{ $schoolClass->students->count() }})</h3>
                @forelse($schoolClass->students as $student)
                <div class="flex justify-between items-center py-3 border-b last:border-0">
                    <div>
                        <p class="font-medium text-gray-800">{{ $student->name }}</p>
                        <p class="text-sm text-gray-500">{{ $student->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.classes.unenroll', [$schoolClass, $student]) }}" onsubmit="return confirm('Remove this student?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:text-red-800 text-sm">Remove</button>
                    </form>
                </div>
                @empty
                <p class="text-gray-400 text-center py-4">No students enrolled yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
