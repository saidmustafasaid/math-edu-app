<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassEnrollment extends Model
{
    use HasFactory;

    protected $table = 'class_enrollments';

    protected $fillable = ['school_class_id', 'student_id'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
