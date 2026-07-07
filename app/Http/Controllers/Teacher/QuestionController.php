<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function create(Test $test)
    {
        if ($test->teacher_id !== Auth::id()) abort(403);
        return view('teacher.questions.create', compact('test'));
    }

    public function store(Request $request, Test $test)
    {
        if ($test->teacher_id !== Auth::id()) abort(403);
        $request->validate([
            'question_text'  => ['required', 'string'],
            'option_a'       => ['required', 'string', 'max:500'],
            'option_b'       => ['required', 'string', 'max:500'],
            'option_c'       => ['nullable', 'string', 'max:500'],
            'option_d'       => ['nullable', 'string', 'max:500'],
            'correct_answer' => ['required', 'in:A,B,C,D'],
            'marks'          => ['required', 'integer', 'min:1'],
        ]);

        Question::create([...$request->only('question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer', 'marks'), 'test_id' => $test->id]);

        if ($request->input('add_another')) {
            return back()->with('success', 'Question added. Add another question.');
        }

        return redirect()->route('teacher.tests.show', $test)->with('success', 'Question added successfully.');
    }

    public function destroy(Test $test, Question $question)
    {
        if ($test->teacher_id !== Auth::id()) abort(403);
        $question->delete();
        return back()->with('success', 'Question deleted.');
    }
}
