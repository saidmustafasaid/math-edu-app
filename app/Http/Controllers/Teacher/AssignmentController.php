<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('teacher_id', Auth::id())
            ->with(['schoolClass', 'subject'])
            ->withCount('submissions')
            ->latest()
            ->get();
        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $classes  = Auth::user()->taughtClasses()->get();
        $subjects = Subject::orderBy('name')->get();
        return view('teacher.assignments.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'subject_id'      => ['nullable', 'exists:subjects,id'],
            'due_date'        => ['required', 'date'],
            'max_marks'       => ['required', 'integer', 'min:1'],
        ]);

        Assignment::create([...$request->only('title', 'description', 'school_class_id', 'subject_id', 'due_date', 'max_marks'), 'teacher_id' => Auth::id()]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function show(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) abort(403);
        $assignment->load(['schoolClass', 'subject', 'submissions.student']);
        return view('teacher.assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) abort(403);
        $classes  = Auth::user()->taughtClasses()->get();
        $subjects = Subject::orderBy('name')->get();
        return view('teacher.assignments.edit', compact('assignment', 'classes', 'subjects'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) abort(403);
        $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'subject_id'      => ['nullable', 'exists:subjects,id'],
            'due_date'        => ['required', 'date'],
            'max_marks'       => ['required', 'integer', 'min:1'],
        ]);

        $assignment->update($request->only('title', 'description', 'school_class_id', 'subject_id', 'due_date', 'max_marks'));

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) abort(403);
        $assignment->delete();
        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment deleted.');
    }

    public function grade(Request $request, AssignmentSubmission $submission)
    {
        if ($submission->assignment->teacher_id !== Auth::id()) abort(403);
        $request->validate([
            'grade'    => ['required', 'integer', 'min:0', 'max:' . $submission->assignment->max_marks],
            'feedback' => ['nullable', 'string'],
        ]);

        $submission->update(['grade' => $request->grade, 'feedback' => $request->feedback]);

        return back()->with('success', 'Grade saved successfully.');
    }
}
