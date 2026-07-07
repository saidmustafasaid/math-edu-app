<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Student Dashboard</h1>
        <p class="text-sm text-gray-500">Welcome back, {{ $student->name }}</p>
    </x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label' => 'My Classes',         'value' => $stats['classes'],            'color' => 'green', 'icon' => '🏫'],
                ['label' => 'Notes Available',     'value' => $stats['notes'],              'color' => 'blue',   'icon' => '📄'],
                ['label' => 'Pending Assignments', 'value' => $stats['pendingAssignments'], 'color' => 'yellow', 'icon' => '✏️'],
                ['label' => 'Tests Completed',     'value' => $stats['completedTests'],     'color' => 'green',  'icon' => '✅'],
            ] as $stat)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xl">{{ $stat['icon'] }}</span>
                    <span class="text-xs font-medium text-{{ $stat['color'] }}-600 bg-{{ $stat['color'] }}-50 px-2 py-0.5 rounded-full">active</span>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ $stat['value'] }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        @if($stats['classes'] === 0)
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 flex items-start gap-4">
            <span class="text-2xl">⚠️</span>
            <div>
                <p class="font-semibold text-amber-800">Not enrolled in any class yet</p>
                <p class="text-sm text-amber-600 mt-0.5">Please contact your school administrator to be enrolled.</p>
            </div>
        </div>
        @endif

        {{-- Quick access --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Quick Access</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('student.notes') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    📄 View Notes
                </a>
                <a href="{{ route('student.assignments') }}"
                   class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    ✏️ Assignments
                </a>
                <a href="{{ route('student.tests') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    📋 Tests
                </a>
                <a href="{{ route('formulas') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    📐 Formulas
                </a>
                <a href="{{ route('calculator') }}"
                   class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    🔢 Calculator
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Recent Notes --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-semibold text-gray-900">Recent Notes</h2>
                    <a href="{{ route('student.notes') }}" class="text-xs text-green-600 hover:text-green-800 font-medium">View all →</a>
                </div>
                <div class="space-y-1">
                    @forelse($recentNotes as $note)
                    <a href="{{ route('student.notes.show', $note) }}"
                       class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 text-sm">📄</div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate group-hover:text-green-600">{{ $note->title }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $note->schoolClass->name }} · {{ $note->created_at->format('d M Y') }}</p>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-8 text-gray-400">
                        <div class="text-3xl mb-2">📭</div>
                        <p class="text-sm">No notes available yet</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Pending Assignments --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-semibold text-gray-900">Pending Assignments</h2>
                    <a href="{{ route('student.assignments') }}" class="text-xs text-green-600 hover:text-green-800 font-medium">View all →</a>
                </div>
                <div class="space-y-1">
                    @forelse($pendingAssignments as $assignment)
                    <a href="{{ route('student.assignments.show', $assignment) }}"
                       class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center shrink-0 text-sm">✏️</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate group-hover:text-green-600">{{ $assignment->title }}</p>
                            <p class="text-xs text-gray-500">{{ $assignment->schoolClass->name }}</p>
                        </div>
                        <span class="text-xs font-semibold shrink-0 {{ $assignment->due_date->diffInDays() <= 2 ? 'text-red-600' : 'text-gray-500' }}">
                            Due {{ $assignment->due_date->format('d M') }}
                        </span>
                    </a>
                    @empty
                    <div class="text-center py-8 text-gray-400">
                        <div class="text-3xl mb-2">🎉</div>
                        <p class="text-sm">No pending assignments!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Available Tests --}}
        @if($availableTests->count())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-semibold text-gray-900">Available Tests</h2>
                <a href="{{ route('student.tests') }}" class="text-xs text-green-600 hover:text-green-800 font-medium">View all →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($availableTests as $test)
                <a href="{{ route('student.tests.start', $test) }}"
                   class="border-2 border-green-100 hover:border-green-400 rounded-xl p-4 transition group">
                    <p class="font-semibold text-gray-900 group-hover:text-green-600">{{ $test->title }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $test->schoolClass->name }}</p>
                    <div class="flex items-center gap-3 mt-3 text-xs text-green-600">
                        <span>⏱ {{ $test->duration_minutes }} min</span>
                        <span>❓ {{ $test->questions_count }} questions</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</x-app-layout>
