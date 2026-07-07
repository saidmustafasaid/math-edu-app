<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('teacher_id', Auth::id())
            ->with(['schoolClass', 'subject'])
            ->latest()
            ->get();
        return view('teacher.notes.index', compact('notes'));
    }

    public function create()
    {
        $classes  = Auth::user()->taughtClasses()->get();
        $subjects = Subject::orderBy('name')->get();
        return view('teacher.notes.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'content'         => ['required', 'string'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'subject_id'      => ['nullable', 'exists:subjects,id'],
        ]);

        Note::create([...$request->only('title', 'content', 'school_class_id', 'subject_id'), 'teacher_id' => Auth::id()]);

        return redirect()->route('teacher.notes.index')->with('success', 'Note published successfully.');
    }

    public function edit(Note $note)
    {
        if ($note->teacher_id !== Auth::id()) abort(403);
        $classes  = Auth::user()->taughtClasses()->get();
        $subjects = Subject::orderBy('name')->get();
        return view('teacher.notes.edit', compact('note', 'classes', 'subjects'));
    }

    public function update(Request $request, Note $note)
    {
        if ($note->teacher_id !== Auth::id()) abort(403);
        $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'content'         => ['required', 'string'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'subject_id'      => ['nullable', 'exists:subjects,id'],
        ]);

        $note->update($request->only('title', 'content', 'school_class_id', 'subject_id'));

        return redirect()->route('teacher.notes.index')->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $note)
    {
        if ($note->teacher_id !== Auth::id()) abort(403);
        $note->delete();
        return redirect()->route('teacher.notes.index')->with('success', 'Note deleted.');
    }
}
