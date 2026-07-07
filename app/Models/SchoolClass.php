<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'school_classes';

    protected $fillable = ['name', 'description', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_enrollments', 'school_class_id', 'student_id');
    }

    public function enrollments()
    {
        return $this->hasMany(ClassEnrollment::class, 'school_class_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'school_class_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'school_class_id');
    }

    public function tests()
    {
        return $this->hasMany(Test::class, 'school_class_id');
    }
}
