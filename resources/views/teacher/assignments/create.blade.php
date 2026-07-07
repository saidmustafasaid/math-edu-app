<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create Assignment</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                @if($classes->isEmpty())
                <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded">
                    You have no classes assigned yet. Please contact the admin.
                </div>
                @else
                <form method="POST" action="{{ route('teacher.assignments.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Assignment Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Instructions / Description" />
                        <textarea id="description" name="description" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="school_class_id" value="Class" />
                            <select id="school_class_id" name="school_class_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Select Class --</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('school_class_id', request('class')) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('school_class_id')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="subject_id" value="Subject (optional)" />
                            <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="due_date" value="Due Date & Time" />
                            <x-text-input id="due_date" name="due_date" type="datetime-local" class="mt-1 block w-full" :value="old('due_date')" required />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="max_marks" value="Maximum Marks" />
                            <x-text-input id="max_marks" name="max_marks" type="number" min="1" class="mt-1 block w-full" :value="old('max_marks', 100)" required />
                            <x-input-error :messages="$errors->get('max_marks')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Create Assignment</x-primary-button>
                        <a href="{{ route('teacher.assignments.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
