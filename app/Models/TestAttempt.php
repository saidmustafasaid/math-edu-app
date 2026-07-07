<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'student_id', 'started_at', 'submitted_at', 'score', 'total_marks'];

    protected $casts = [
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function answers()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}
