<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Test</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.tests.update', $test) }}" class="space-y-5">
                    @csrf @method('PATCH')

                    <div>
                        <x-input-label for="title" value="Test Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $test->title)" required />
                    </div>

                    <div>
                        <x-input-label for="description" value="Description (optional)" />
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $test->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="school_class_id" value="Class" />
                            <select id="school_class_id" name="school_class_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('school_class_id', $test->school_class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="subject_id" value="Subject (optional)" />
                            <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- None --</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id', $test->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="duration_minutes" value="Duration (minutes)" />
                        <x-text-input id="duration_minutes" name="duration_minutes" type="number" min="1" class="mt-1 block w-48" :value="old('duration_minutes', $test->duration_minutes)" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_time" value="Available From (optional)" />
                            <x-text-input id="start_time" name="start_time" type="datetime-local" class="mt-1 block w-full" :value="old('start_time', $test->start_time?->format('Y-m-d\TH:i'))" />
                        </div>
                        <div>
                            <x-input-label for="end_time" value="Available Until (optional)" />
                            <x-text-input id="end_time" name="end_time" type="datetime-local" class="mt-1 block w-full" :value="old('end_time', $test->end_time?->format('Y-m-d\TH:i'))" />
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Update Test</x-primary-button>
                        <a href="{{ route('teacher.tests.show', $test) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
