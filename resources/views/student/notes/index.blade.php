<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My Notes</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($notes->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-500">No notes available in your classes yet.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($notes as $note)
                <a href="{{ route('student.notes.show', $note) }}" class="bg-white rounded-lg shadow p-5 hover:shadow-md transition block">
                    <div class="flex justify-between items-start mb-2">
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">{{ $note->schoolClass->name }}</span>
                        @if($note->subject)<span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $note->subject->name }}</span>@endif
                    </div>
                    <h3 class="font-semibold text-gray-800 mt-2">{{ $note->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ Str::limit(strip_tags($note->content), 100) }}</p>
                    <div class="mt-3 flex justify-between text-xs text-gray-400">
                        <span>By {{ $note->teacher->name }}</span>
                        <span>{{ $note->created_at->format('d M Y') }}</span>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="mt-4">{{ $notes->links() }}</div>
            @endif

        </div>
    </div>
</x-app-layout>
