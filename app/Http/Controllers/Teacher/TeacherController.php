<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::user();
        $classes = $teacher->taughtClasses()->withCount('students')->get();

        $pendingGrading = AssignmentSubmission::whereHas(
            'assignment', fn($q) => $q->where('teacher_id', $teacher->id)
        )->whereNull('grade')->count();

        $recentNotes   = $teacher->notes()->with('schoolClass')->latest()->take(5)->get();
        $upcomingTests = $teacher->tests()->where(
            fn($q) => $q->whereNull('start_time')->orWhere('start_time', '>=', now())
        )->orderBy('start_time')->take(5)->get();

        $stats = [
            'classes'        => $classes->count(),
            'notes'          => $teacher->notes()->count(),
            'assignments'    => $teacher->assignments()->count(),
            'tests'          => $teacher->tests()->count(),
            'pendingGrading' => $pendingGrading,
        ];

        return view('teacher.dashboard', compact('teacher', 'classes', 'recentNotes', 'upcomingTests', 'stats'));
    }
}
