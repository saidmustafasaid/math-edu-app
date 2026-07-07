<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Admin Dashboard</h1>
        <p class="text-sm text-gray-500">System overview</p>
    </x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['label' => 'Students',    'value' => $stats['students'],    'color' => 'blue',   'icon' => '👨‍🎓'],
                ['label' => 'Teachers',    'value' => $stats['teachers'],    'color' => 'green',  'icon' => '👨‍🏫'],
                ['label' => 'Classes',     'value' => $stats['classes'],     'color' => 'green', 'icon' => '🏫'],
                ['label' => 'Notes',       'value' => $stats['notes'],       'color' => 'yellow', 'icon' => '📄'],
                ['label' => 'Assignments', 'value' => $stats['assignments'], 'color' => 'orange', 'icon' => '✏️'],
                ['label' => 'Tests',       'value' => $stats['tests'],       'color' => 'purple', 'icon' => '📋'],
            ] as $stat)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="text-xl mb-3">{{ $stat['icon'] }}</div>
                <p class="text-3xl font-bold text-gray-900">{{ $stat['value'] }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Quick actions --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Quick Actions</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.users.create') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    + Register User
                </a>
                <a href="{{ route('admin.classes.create') }}"
                   class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    + Create Class
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    Manage Users
                </a>
                <a href="{{ route('admin.classes.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    Manage Classes
                </a>
                <a href="{{ route('formulas') }}"
                   class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    📐 Formulas
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Recent Users --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-semibold text-gray-900">Recent Users</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-xs text-green-600 hover:text-green-800 font-medium">View all →</a>
                </div>
                <div class="space-y-1">
                    @foreach($recentUsers as $user)
                    <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-sm font-bold text-green-700 shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                        <span class="text-xs font-medium px-2 py-1 rounded-full shrink-0
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' :
                               ($user->role === 'teacher' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Classes --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-semibold text-gray-900">Classes</h2>
                    <a href="{{ route('admin.classes.index') }}" class="text-xs text-green-600 hover:text-green-800 font-medium">View all →</a>
                </div>
                <div class="space-y-1">
                    @forelse($recentClasses as $class)
                    <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-sm shrink-0">🏫</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800">{{ $class->name }}</p>
                            <p class="text-xs text-gray-500">{{ $class->teacher->name }}</p>
                        </div>
                        <span class="text-xs font-semibold text-green-700 bg-green-50 px-2 py-1 rounded-full shrink-0">
                            {{ $class->students_count }} students
                        </span>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-400">
                        <div class="text-3xl mb-2">🏫</div>
                        <p class="text-sm">No classes created yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
