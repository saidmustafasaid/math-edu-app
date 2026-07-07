<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Class: {{ $schoolClass->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('admin.classes.update', $schoolClass) }}" class="space-y-5">
                    @csrf @method('PATCH')

                    <div>
                        <x-input-label for="name" value="Class Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $schoolClass->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Description (optional)" />
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $schoolClass->description) }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="teacher_id" value="Assign Teacher" />
                        <select id="teacher_id" name="teacher_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $schoolClass->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('teacher_id')" class="mt-1" />
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Update Class</x-primary-button>
                        <a href="{{ route('admin.classes.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
