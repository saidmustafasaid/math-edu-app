<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MathEduApp') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">

            {{-- Left branding panel --}}
            <div class="hidden lg:flex w-5/12 flex-col items-center justify-center p-12 relative overflow-hidden"
                 style="background: linear-gradient(140deg, #312e81 0%, #4338ca 50%, #0ea5e9 100%);">

                {{-- Decorative floating circles --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-12 left-12 w-44 h-44 rounded-full border-2 border-white/15"></div>
                    <div class="absolute bottom-16 right-8 w-64 h-64 rounded-full border-2 border-white/10"></div>
                    <div class="absolute top-1/2 left-1/3 w-28 h-28 rounded-full border border-white/20"></div>
                    <div class="absolute top-1/4 right-1/4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="absolute bottom-1/3 left-1/4 w-20 h-20 rounded-full bg-white/5"></div>
                </div>

                <div class="relative text-center text-white z-10">
                    <div class="w-20 h-20 rounded-2xl bg-white/15 border border-white/30 flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                        <span class="text-5xl font-black text-white leading-none">∑</span>
                    </div>
                    <h1 class="text-4xl font-black tracking-tight">MathEduApp</h1>
                    <p class="text-indigo-200 mt-3 text-lg font-medium">Empowering math education</p>

                    <div class="mt-12 grid grid-cols-3 gap-6 text-center">
                        <div class="bg-white/10 rounded-2xl p-4 border border-white/20 backdrop-blur-sm">
                            <p class="text-2xl font-bold text-yellow-300">127+</p>
                            <p class="text-xs text-indigo-200 mt-1 font-medium">Formulas</p>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-4 border border-white/20 backdrop-blur-sm">
                            <p class="text-2xl font-bold text-yellow-300">π</p>
                            <p class="text-xs text-indigo-200 mt-1 font-medium">Precision</p>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-4 border border-white/20 backdrop-blur-sm">
                            <p class="text-2xl font-bold text-yellow-300">√</p>
                            <p class="text-xs text-indigo-200 mt-1 font-medium">Solutions</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right form panel --}}
            <div class="flex-1 flex items-center justify-center p-8 bg-slate-50">
                <div class="w-full max-w-md">

                    {{-- Mobile logo --}}
                    <div class="lg:hidden text-center mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center mx-auto mb-3">
                            <span class="text-3xl font-black text-white leading-none">∑</span>
                        </div>
                        <h1 class="text-2xl font-black text-slate-900">MathEduApp</h1>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                        {{ $slot }}
                    </div>

                    <p class="text-center text-xs text-slate-400 mt-6">
                        <a href="{{ url('/') }}" class="hover:text-indigo-600 transition font-medium">← Back to home</a>
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>
