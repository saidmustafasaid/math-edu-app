<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['test_attempt_id', 'question_id', 'answer', 'is_correct'];

    public function attempt()
    {
        return $this->belongsTo(TestAttempt::class, 'test_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
