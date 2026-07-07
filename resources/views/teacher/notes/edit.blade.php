<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Note</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.notes.update', $note) }}" class="space-y-5">
                    @csrf @method('PATCH')

                    <div>
                        <x-input-label for="title" value="Note Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $note->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="school_class_id" value="Class" />
                            <select id="school_class_id" name="school_class_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('school_class_id', $note->school_class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="subject_id" value="Subject (optional)" />
                            <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- None --</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id', $note->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="content" value="Note Content" />
                        <textarea id="content" name="content" rows="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm" required>{{ old('content', $note->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-1" />
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Update Note</x-primary-button>
                        <a href="{{ route('teacher.notes.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
