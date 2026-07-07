<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Post New Note</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if($classes->isEmpty())
                <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded mb-4">
                    You have no classes assigned yet. Please contact the admin.
                </div>
                @else

                <form method="POST" action="{{ route('teacher.notes.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Note Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required placeholder="e.g. Chapter 3: Algebra Introduction" />
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="school_class_id" value="Class" />
                            <select id="school_class_id" name="school_class_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">-- Select Class --</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('school_class_id', request('class')) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('school_class_id')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="subject_id" value="Subject (optional)" />
                            <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="content" value="Note Content" />
                        <textarea id="content" name="content" rows="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono text-sm" required placeholder="Write your note here...">{{ old('content') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">You can use plain text. Press Enter for new lines.</p>
                        <x-input-error :messages="$errors->get('content')" class="mt-1" />
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Publish Note</x-primary-button>
                        <a href="{{ route('teacher.notes.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
