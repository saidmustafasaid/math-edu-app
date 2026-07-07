<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-VHHX6QYHMN"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'G-VHHX6QYHMN');
        </script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MathEduApp') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">

        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

            {{-- Mobile backdrop --}}
            <div x-show="sidebarOpen"
                 x-transition:enter="transition-opacity ease-linear duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false"
                 class="fixed inset-0 z-20 bg-black/40 lg:hidden"
                 style="display: none;"></div>

            {{-- Sidebar --}}
            @include('layouts.navigation')

            {{-- Main area --}}
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

                {{-- Top bar --}}
                <div class="bg-white border-b border-slate-200 flex items-center gap-4 px-6 h-16 shrink-0 shadow-sm">
                    <button @click="sidebarOpen = true"
                            class="lg:hidden p-1.5 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    @isset($header)
                        <div class="flex-1">{{ $header }}</div>
                    @endisset
                    {{-- Home link --}}
                    <a href="{{ url('/') }}"
                       class="ml-auto hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Home
                    </a>
                </div>

                <main class="flex-1 overflow-y-auto p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

    </body>
</html>
