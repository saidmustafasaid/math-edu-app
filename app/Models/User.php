<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isTeacher(): bool { return $this->role === 'teacher'; }
    public function isStudent(): bool { return $this->role === 'student'; }

    public function taughtClasses() { return $this->hasMany(SchoolClass::class, 'teacher_id'); }
    public function notes() { return $this->hasMany(Note::class, 'teacher_id'); }
    public function assignments() { return $this->hasMany(Assignment::class, 'teacher_id'); }
    public function tests() { return $this->hasMany(Test::class, 'teacher_id'); }

    public function enrolledClasses() { return $this->belongsToMany(SchoolClass::class, 'class_enrollments', 'student_id', 'school_class_id'); }
    public function testAttempts() { return $this->hasMany(TestAttempt::class, 'student_id'); }
    public function assignmentSubmissions() { return $this->hasMany(AssignmentSubmission::class, 'student_id'); }
}
