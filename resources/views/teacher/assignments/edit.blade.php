<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Assignment</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.assignments.update', $assignment) }}" class="space-y-5">
                    @csrf @method('PATCH')

                    <div>
                        <x-input-label for="title" value="Assignment Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $assignment->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Instructions / Description" />
                        <textarea id="description" name="description" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $assignment->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="school_class_id" value="Class" />
                            <select id="school_class_id" name="school_class_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('school_class_id', $assignment->school_class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="subject_id" value="Subject (optional)" />
                            <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- None --</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id', $assignment->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="due_date" value="Due Date & Time" />
                            <x-text-input id="due_date" name="due_date" type="datetime-local" class="mt-1 block w-full" :value="old('due_date', $assignment->due_date->format('Y-m-d\TH:i'))" required />
                        </div>
                        <div>
                            <x-input-label for="max_marks" value="Maximum Marks" />
                            <x-text-input id="max_marks" name="max_marks" type="number" min="1" class="mt-1 block w-full" :value="old('max_marks', $assignment->max_marks)" required />
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Update Assignment</x-primary-button>
                        <a href="{{ route('teacher.assignments.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
