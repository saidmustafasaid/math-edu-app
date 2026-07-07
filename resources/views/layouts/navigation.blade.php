{{-- Sidebar --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
       class="fixed lg:static inset-y-0 left-0 z-30 w-64 flex flex-col bg-slate-900 text-white transition-transform duration-200 ease-in-out shrink-0">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-5 h-16 border-b border-slate-800 shrink-0">
        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center shrink-0">
            <span class="text-base font-black text-white leading-none">∑</span>
        </div>
        <span class="text-base font-bold tracking-tight text-white">MathEduApp</span>
    </div>

    @auth
    {{-- User card --}}
    <div class="px-4 py-3 border-b border-slate-800">
        <div class="flex items-center gap-3 bg-slate-800 rounded-xl p-3">
            <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-sm font-bold shrink-0 text-white">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold truncate text-white">{{ Auth::user()->name }}</p>
                <span class="inline-block text-xs px-2 py-0.5 rounded-full mt-0.5 font-semibold
                    {{ Auth::user()->role === 'admin'   ? 'bg-red-900/60 text-red-300' :
                       (Auth::user()->role === 'teacher' ? 'bg-sky-900/60 text-sky-300' : 'bg-indigo-900/60 text-indigo-300') }}">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

        @if(Auth::user()->isAdmin())
            <p class="px-3 pt-2 pb-1 text-xs font-bold text-slate-500 uppercase tracking-wider">Admin</p>
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/></svg>
                Dashboard
            </x-nav-link>
            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Users
            </x-nav-link>
            <x-nav-link :href="route('admin.classes.index')" :active="request()->routeIs('admin.classes.*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h6m-6 4h6m-6 4h6"/></svg>
                Classes
            </x-nav-link>

        @elseif(Auth::user()->isTeacher())
            <p class="px-3 pt-2 pb-1 text-xs font-bold text-slate-500 uppercase tracking-wider">Teaching</p>
            <x-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </x-nav-link>
            <x-nav-link :href="route('teacher.notes.index')" :active="request()->routeIs('teacher.notes.*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Notes
            </x-nav-link>
            <x-nav-link :href="route('teacher.assignments.index')" :active="request()->routeIs('teacher.assignments.*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Assignments
            </x-nav-link>
            <x-nav-link :href="route('teacher.tests.index')" :active="request()->routeIs('teacher.tests.*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M12 18h.01M8 18h.01M16 18h.01"/></svg>
                Tests
            </x-nav-link>

        @else
            <p class="px-3 pt-2 pb-1 text-xs font-bold text-slate-500 uppercase tracking-wider">Learning</p>
            <x-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </x-nav-link>
            <x-nav-link :href="route('student.notes')" :active="request()->routeIs('student.notes*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Notes
            </x-nav-link>
            <x-nav-link :href="route('student.assignments')" :active="request()->routeIs('student.assignments*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 14l2 2 4-4"/></svg>
                Assignments
            </x-nav-link>
            <x-nav-link :href="route('student.tests')" :active="request()->routeIs('student.tests*')">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M12 18h.01M8 18h.01M16 18h.01"/></svg>
                Tests
            </x-nav-link>
        @endif

        <p class="px-3 pt-4 pb-1 text-xs font-bold text-slate-500 uppercase tracking-wider">Math Tools</p>
        <x-nav-link :href="route('formulas')" :active="request()->routeIs('formulas')">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h10M4 17h7"/><rect x="14" y="13" width="7" height="7" rx="1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
            Formulas
        </x-nav-link>
        <x-nav-link :href="route('calculator')" :active="request()->routeIs('calculator')">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><line x1="8" y1="6" x2="16" y2="6" stroke-linecap="round" stroke-width="2"/><line x1="8" y1="10" x2="10" y2="10" stroke-linecap="round" stroke-width="2"/><line x1="14" y1="10" x2="16" y2="10" stroke-linecap="round" stroke-width="2"/></svg>
            Calculator
        </x-nav-link>
        <x-nav-link :href="route('converter')" :active="request()->routeIs('converter')">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4"/></svg>
            Converter
        </x-nav-link>

    </nav>

    {{-- Bottom: profile & logout --}}
    <div class="px-3 py-4 border-t border-slate-800 space-y-0.5 shrink-0">
        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profile
        </x-nav-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition duration-150 cursor-pointer">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Log Out
            </button>
        </form>
    </div>
    @endauth

</aside>
