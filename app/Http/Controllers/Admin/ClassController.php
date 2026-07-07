<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with('teacher')->withCount('students')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();
        return view('admin.classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'teacher_id'  => ['required', 'exists:users,id'],
        ]);

        SchoolClass::create($request->only('name', 'description', 'teacher_id'));

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully.');
    }

    public function show(SchoolClass $schoolClass)
    {
        $schoolClass->load(['teacher', 'students']);
        $students = User::where('role', 'student')->orderBy('name')->get();
        $enrolledIds = $schoolClass->students->pluck('id');
        return view('admin.classes.show', compact('schoolClass', 'students', 'enrolledIds'));
    }

    public function edit(SchoolClass $schoolClass)
    {
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();
        return view('admin.classes.edit', compact('schoolClass', 'teachers'));
    }

    public function update(Request $request, SchoolClass $schoolClass)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'teacher_id'  => ['required', 'exists:users,id'],
        ]);

        $schoolClass->update($request->only('name', 'description', 'teacher_id'));

        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted.');
    }

    public function enroll(Request $request, SchoolClass $schoolClass)
    {
        $request->validate(['student_id' => ['required', 'exists:users,id']]);
        $schoolClass->students()->syncWithoutDetaching([$request->student_id]);
        return back()->with('success', 'Student enrolled successfully.');
    }

    public function unenroll(SchoolClass $schoolClass, User $student)
    {
        $schoolClass->students()->detach($student->id);
        return back()->with('success', 'Student removed from class.');
    }
}
