<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create New Class</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('admin.classes.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Class Name (e.g. Form 1A, Primary 5B)" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Description (optional)" />
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="teacher_id" value="Assign Teacher" />
                        <select id="teacher_id" name="teacher_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required>
                            <option value="">-- Select Teacher --</option>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('teacher_id')" class="mt-1" />
                        @if($teachers->isEmpty())
                        <p class="text-sm text-yellow-600 mt-1">No teachers registered yet. <a href="{{ route('admin.users.create') }}" class="underline">Register a teacher first.</a></p>
                        @endif
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button>Create Class</x-primary-button>
                        <a href="{{ route('admin.classes.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
