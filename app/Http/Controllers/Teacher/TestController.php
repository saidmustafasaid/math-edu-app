<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::where('teacher_id', Auth::id())
            ->with(['schoolClass', 'subject'])
            ->withCount(['questions', 'attempts'])
            ->latest()
            ->get();
        return view('teacher.tests.index', compact('tests'));
    }

    public function create()
    {
        $classes  = Auth::user()->taughtClasses()->get();
        $subjects = Subject::orderBy('name')->get();
        return view('teacher.tests.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'school_class_id'  => ['required', 'exists:school_classes,id'],
            'subject_id'       => ['nullable', 'exists:subjects,id'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'start_time'       => ['nullable', 'date'],
            'end_time'         => ['nullable', 'date'],
        ]);

        $test = Test::create([...$request->only('title', 'description', 'school_class_id', 'subject_id', 'duration_minutes', 'start_time', 'end_time'), 'teacher_id' => Auth::id()]);

        return redirect()->route('teacher.tests.show', $test)->with('success', 'Test created. Now add questions.');
    }

    public function show(Test $test)
    {
        if ($test->teacher_id !== Auth::id()) abort(403);
        $test->load(['questions', 'schoolClass', 'subject', 'attempts.student']);
        return view('teacher.tests.show', compact('test'));
    }

    public function edit(Test $test)
    {
        if ($test->teacher_id !== Auth::id()) abort(403);
        $classes  = Auth::user()->taughtClasses()->get();
        $subjects = Subject::orderBy('name')->get();
        return view('teacher.tests.edit', compact('test', 'classes', 'subjects'));
    }

    public function update(Request $request, Test $test)
    {
        if ($test->teacher_id !== Auth::id()) abort(403);
        $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'school_class_id'  => ['required', 'exists:school_classes,id'],
            'subject_id'       => ['nullable', 'exists:subjects,id'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'start_time'       => ['nullable', 'date'],
            'end_time'         => ['nullable', 'date'],
        ]);

        $test->update($request->only('title', 'description', 'school_class_id', 'subject_id', 'duration_minutes', 'start_time', 'end_time'));

        return redirect()->route('teacher.tests.show', $test)->with('success', 'Test updated.');
    }

    public function destroy(Test $test)
    {
        if ($test->teacher_id !== Auth::id()) abort(403);
        $test->delete();
        return redirect()->route('teacher.tests.index')->with('success', 'Test deleted.');
    }
}
