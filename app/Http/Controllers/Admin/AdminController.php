<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Note;
use App\Models\Assignment;
use App\Models\Test;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'students'    => User::where('role', 'student')->count(),
            'teachers'    => User::where('role', 'teacher')->count(),
            'classes'     => SchoolClass::count(),
            'notes'       => Note::count(),
            'assignments' => Assignment::count(),
            'tests'       => Test::count(),
        ];

        $recentUsers   = User::latest()->take(5)->get();
        $recentClasses = SchoolClass::with('teacher')->withCount('students')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentClasses'));
    }
}
