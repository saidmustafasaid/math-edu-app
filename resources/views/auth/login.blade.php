<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-7">
        <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
        <p class="text-sm text-gray-500 mt-1">Sign in to your account to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')"
                          required autofocus autocomplete="username"
                          placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-1">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-green-600 hover:text-green-800 font-medium"
                       href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <x-text-input id="password" type="password" name="password"
                          required autocomplete="current-password"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
            <label for="remember_me" class="text-sm text-gray-600">Remember me</label>
        </div>

        <x-primary-button class="w-full">
            Sign in
        </x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 font-medium">Register here</a>
    </p>
</x-guest-layout>
