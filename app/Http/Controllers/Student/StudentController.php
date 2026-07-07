<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    private function classIds()
    {
        return Auth::user()->enrolledClasses()->pluck('school_classes.id');
    }

    public function dashboard()
    {
        $student  = Auth::user();
        $classIds = $this->classIds();

        $recentNotes = Note::whereIn('school_class_id', $classIds)
            ->with(['teacher', 'schoolClass', 'subject'])
            ->latest()->take(5)->get();

        $pendingAssignments = Assignment::whereIn('school_class_id', $classIds)
            ->whereDoesntHave('submissions', fn($q) => $q->where('student_id', $student->id))
            ->where('due_date', '>=', now())
            ->orderBy('due_date')->take(5)->get();

        $availableTests = Test::whereIn('school_class_id', $classIds)
            ->whereDoesntHave('attempts', fn($q) => $q->where('student_id', $student->id)->whereNotNull('submitted_at'))
            ->where(fn($q) => $q->whereNull('end_time')->orWhere('end_time', '>=', now()))
            ->orderBy('start_time')->take(5)->get();

        $stats = [
            'classes'            => $classIds->count(),
            'notes'              => Note::whereIn('school_class_id', $classIds)->count(),
            'pendingAssignments' => Assignment::whereIn('school_class_id', $classIds)
                ->whereDoesntHave('submissions', fn($q) => $q->where('student_id', $student->id))->count(),
            'completedTests'     => TestAttempt::where('student_id', $student->id)->whereNotNull('submitted_at')->count(),
        ];

        return view('student.dashboard', compact('student', 'recentNotes', 'pendingAssignments', 'availableTests', 'stats'));
    }

    public function notes()
    {
        $notes = Note::whereIn('school_class_id', $this->classIds())
            ->with(['teacher', 'schoolClass', 'subject'])
            ->latest()->paginate(15);
        return view('student.notes.index', compact('notes'));
    }

    public function showNote(Note $note)
    {
        if (!$this->classIds()->contains($note->school_class_id)) abort(403);
        $note->load(['teacher', 'schoolClass', 'subject']);
        return view('student.notes.show', compact('note'));
    }

    public function assignments()
    {
        $student  = Auth::user();
        $classIds = $this->classIds();
        $assignments = Assignment::whereIn('school_class_id', $classIds)
            ->with(['schoolClass', 'subject'])
            ->orderBy('due_date')->get();

        $submittedIds = AssignmentSubmission::where('student_id', $student->id)->pluck('assignment_id');

        return view('student.assignments.index', compact('assignments', 'submittedIds'));
    }

    public function showAssignment(Assignment $assignment)
    {
        if (!$this->classIds()->contains($assignment->school_class_id)) abort(403);
        $assignment->load(['schoolClass', 'subject', 'teacher']);
        $submission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())->first();
        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submitAssignment(Request $request, Assignment $assignment)
    {
        if (!$this->classIds()->contains($assignment->school_class_id)) abort(403);
        $request->validate(['content' => ['required', 'string']]);

        AssignmentSubmission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'student_id' => Auth::id()],
            ['content' => $request->content, 'submitted_at' => now()]
        );

        return back()->with('success', 'Assignment submitted successfully.');
    }

    public function tests()
    {
        $student  = Auth::user();
        $classIds = $this->classIds();
        $tests = Test::whereIn('school_class_id', $classIds)
            ->with(['schoolClass', 'subject'])
            ->withCount('questions')
            ->orderBy('start_time')->get();

        $completedIds = TestAttempt::where('student_id', $student->id)
            ->whereNotNull('submitted_at')->pluck('test_id');

        return view('student.tests.index', compact('tests', 'completedIds'));
    }

    public function startTest(Test $test)
    {
        if (!$this->classIds()->contains($test->school_class_id)) abort(403);

        $existing = TestAttempt::where('test_id', $test->id)
            ->where('student_id', Auth::id())
            ->whereNotNull('submitted_at')->first();

        if ($existing) return redirect()->route('student.tests.result', $existing);

        $attempt = TestAttempt::firstOrCreate(
            ['test_id' => $test->id, 'student_id' => Auth::id()],
            ['started_at' => now()]
        );

        $test->load('questions');
        return view('student.tests.take', compact('test', 'attempt'));
    }

    public function submitTest(Request $request, Test $test)
    {
        if (!$this->classIds()->contains($test->school_class_id)) abort(403);

        $attempt = TestAttempt::where('test_id', $test->id)
            ->where('student_id', Auth::id())
            ->whereNull('submitted_at')->firstOrFail();

        $questions   = $test->questions;
        $score       = 0;
        $totalMarks  = $questions->sum('marks');

        foreach ($questions as $question) {
            $answer    = strtoupper($request->input('answers.' . $question->id, ''));
            $isCorrect = $answer === strtoupper($question->correct_answer);

            StudentAnswer::updateOrCreate(
                ['test_attempt_id' => $attempt->id, 'question_id' => $question->id],
                ['answer' => $answer ?: null, 'is_correct' => $isCorrect]
            );

            if ($isCorrect) $score += $question->marks;
        }

        $attempt->update(['submitted_at' => now(), 'score' => $score, 'total_marks' => $totalMarks]);

        return redirect()->route('student.tests.result', $attempt);
    }

    public function testResult(TestAttempt $attempt)
    {
        if ($attempt->student_id !== Auth::id()) abort(403);
        $attempt->load(['test', 'answers.question']);
        return view('student.tests.result', compact('attempt'));
    }
}
