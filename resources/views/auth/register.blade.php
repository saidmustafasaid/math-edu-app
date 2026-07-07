<x-guest-layout>
    <div class="mb-7">
        <h2 class="text-2xl font-bold text-gray-900">Create an account</h2>
        <p class="text-sm text-gray-500 mt-1">Join MathEduApp as a teacher or student</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')"
                          required autofocus autocomplete="name"
                          placeholder="Your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')"
                          required autocomplete="username"
                          placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        {{-- Role selector --}}
        <div>
            <x-input-label for="role" :value="__('I am a')" />
            <div class="grid grid-cols-2 gap-3 mt-1">
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="student"
                           class="sr-only peer" {{ old('role') === 'student' ? 'checked' : '' }} required>
                    <div class="border-2 border-gray-200 rounded-xl p-4 text-center transition
                                peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-gray-300">
                        <div class="text-2xl mb-1">📚</div>
                        <p class="text-sm font-semibold text-gray-800">Student</p>
                        <p class="text-xs text-gray-500 mt-0.5">I want to learn</p>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="teacher"
                           class="sr-only peer" {{ old('role') === 'teacher' ? 'checked' : '' }}>
                    <div class="border-2 border-gray-200 rounded-xl p-4 text-center transition
                                peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-gray-300">
                        <div class="text-2xl mb-1">🎓</div>
                        <p class="text-sm font-semibold text-gray-800">Teacher</p>
                        <p class="text-xs text-gray-500 mt-0.5">I want to teach</p>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password"
                          required autocomplete="new-password"
                          placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                          required autocomplete="new-password"
                          placeholder="Repeat your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <x-primary-button class="w-full">
            Create account
        </x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        Already have an account?
        <a href="{{ route('login') }}" class="text-green-600 hover:text-green-800 font-medium">Sign in</a>
    </p>
</x-guest-layout>
