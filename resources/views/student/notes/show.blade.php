<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">{{ $note->title }}</h2>
            <a href="{{ route('student.notes') }}" class="text-gray-600 hover:text-gray-800 text-sm">← Back to Notes</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">

                {{-- Note header --}}
                <div class="bg-blue-50 border-b border-blue-100 p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span class="bg-blue-600 text-white text-xs px-3 py-1 rounded-full">{{ $note->schoolClass->name }}</span>
                        @if($note->subject)
                        <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">{{ $note->subject->name }}</span>
                        @endif
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $note->title }}</h1>
                    <div class="mt-2 text-sm text-gray-600">
                        <span>Teacher: <strong>{{ $note->teacher->name }}</strong></span>
                        <span class="mx-2">·</span>
                        <span>{{ $note->created_at->format('d F Y, H:i') }}</span>
                    </div>
                </div>

                {{-- Note Content --}}
                <div class="p-6">
                    <div class="prose max-w-none text-gray-800 whitespace-pre-wrap leading-relaxed">{{ $note->content }}</div>
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 border-t">
                    <div class="flex gap-3">
                        <a href="{{ route('student.notes') }}" class="text-blue-600 hover:underline text-sm">← Back to Notes</a>
                        <a href="{{ route('formulas') }}" class="text-green-600 hover:underline text-sm">View Formulas Reference</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
