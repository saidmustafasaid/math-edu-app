<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Teacher Dashboard</h1>
        <p class="text-sm text-gray-500">Welcome back, {{ $teacher->name }}</p>
    </x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach([
                ['label' => 'My Classes',      'value' => $stats['classes'],        'color' => 'green',  'icon' => '🏫'],
                ['label' => 'Notes Posted',    'value' => $stats['notes'],          'color' => 'blue',   'icon' => '📄'],
                ['label' => 'Assignments',     'value' => $stats['assignments'],    'color' => 'yellow', 'icon' => '✏️'],
                ['label' => 'Tests',           'value' => $stats['tests'],          'color' => 'green', 'icon' => '📋'],
                ['label' => 'Pending Grading', 'value' => $stats['pendingGrading'], 'color' => 'red',    'icon' => '📝'],
            ] as $stat)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xl">{{ $stat['icon'] }}</span>
                    @if($stat['color'] === 'red' && $stat['value'] > 0)
                        <span class="text-xs font-medium text-red-600 bg-red-50 px-2 py-0.5 rounded-full">urgent</span>
                    @endif
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ $stat['value'] }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Quick actions --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Quick Actions</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('teacher.notes.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    + Post Note
                </a>
                <a href="{{ route('teacher.assignments.create') }}"
                   class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    + Create Assignment
                </a>
                <a href="{{ route('teacher.tests.create') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    + Create Test
                </a>
                <a href="{{ route('formulas') }}"
                   class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    📐 Formulas
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- My Classes --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-semibold text-gray-900 mb-5">My Classes</h2>
                <div class="space-y-1">
                    @forelse($classes as $class)
                    <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center shrink-0 text-sm">🏫</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800">{{ $class->name }}</p>
                            <p class="text-xs text-gray-500">{{ $class->students_count }} students</p>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <a href="{{ route('teacher.notes.create') }}?class={{ $class->id }}"
                               class="text-xs text-blue-600 hover:text-blue-800 font-medium">+ Note</a>
                            <a href="{{ route('teacher.assignments.create') }}?class={{ $class->id }}"
                               class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">+ Assignment</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-400">
                        <div class="text-3xl mb-2">🏫</div>
                        <p class="text-sm">No classes assigned yet. Contact your admin.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Notes --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-semibold text-gray-900">Recent Notes</h2>
                    <a href="{{ route('teacher.notes.index') }}" class="text-xs text-green-600 hover:text-green-800 font-medium">View all →</a>
                </div>
                <div class="space-y-1">
                    @forelse($recentNotes as $note)
                    <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 text-sm">📄</div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-800">{{ $note->title }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $note->schoolClass->name }} · {{ $note->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-400">
                        <div class="text-3xl mb-2">📭</div>
                        <p class="text-sm">No notes posted yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Upcoming Tests --}}
        @if($upcomingTests->count())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-semibold text-gray-900">Upcoming Tests</h2>
                <a href="{{ route('teacher.tests.index') }}" class="text-xs text-green-600 hover:text-green-800 font-medium">View all →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($upcomingTests as $test)
                <a href="{{ route('teacher.tests.show', $test) }}"
                   class="border-2 border-green-100 hover:border-green-400 rounded-xl p-4 transition group">
                    <p class="font-semibold text-gray-900 group-hover:text-green-600">{{ $test->title }}</p>
                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                        <span>⏱ {{ $test->duration_minutes }} min</span>
                        <span>👥 {{ $test->attempts_count ?? 0 }} attempts</span>
                    </div>
                    @if($test->start_time)
                    <p class="text-xs text-green-600 mt-2 font-medium">Starts {{ $test->start_time->format('d M Y') }}</p>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</x-app-layout>
