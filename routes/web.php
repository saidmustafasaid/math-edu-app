<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ClassController as AdminClassController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\NoteController;
use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Teacher\TestController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Http\Request;

// Public routes
Route::get('/', fn() => redirect()->route('home'));
Route::get('/home', fn(Request $r) => view('home', ['lang' => $r->input('lang', 'en')]))->name('home');
Route::get('/converter', [ConversionController::class, 'index'])->name('converter');
Route::post('/convert', [ConversionController::class, 'convert'])->name('convert');
Route::get('/calculator', fn() => view('scientific_calculator', ['lang' => request('lang', 'en')]))->name('calculator');
Route::get('/formulas', [FormulaController::class, 'index'])->name('formulas');
Route::get('/constants', fn(Request $r) => view('constants', ['lang' => $r->query('lang', 'en')]));
Route::get('/angles', fn(Request $r) => view('angles', ['lang' => $r->query('lang', 'en')]))->name('angles');

// Dashboard redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin())   return redirect()->route('admin.dashboard');
    if ($user->isTeacher()) return redirect()->route('teacher.dashboard');
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::resource('classes', AdminClassController::class)
            ->parameters(['classes' => 'schoolClass']);
        Route::post('classes/{schoolClass}/enroll', [AdminClassController::class, 'enroll'])->name('classes.enroll');
        Route::delete('classes/{schoolClass}/students/{student}', [AdminClassController::class, 'unenroll'])->name('classes.unenroll');
    });

// Teacher routes
Route::middleware(['auth', 'verified', 'role:teacher,admin'])
    ->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
        Route::resource('notes', NoteController::class)->except(['show']);
        Route::resource('assignments', AssignmentController::class);
        Route::post('assignments/submissions/{submission}/grade', [AssignmentController::class, 'grade'])->name('assignments.grade');
        Route::resource('tests', TestController::class);
        Route::get('tests/{test}/questions/create', [QuestionController::class, 'create'])->name('tests.questions.create');
        Route::post('tests/{test}/questions', [QuestionController::class, 'store'])->name('tests.questions.store');
        Route::delete('tests/{test}/questions/{question}', [QuestionController::class, 'destroy'])->name('tests.questions.destroy');
    });

// Student routes
Route::middleware(['auth', 'verified', 'role:student,teacher,admin'])
    ->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/notes', [StudentController::class, 'notes'])->name('notes');
        Route::get('/notes/{note}', [StudentController::class, 'showNote'])->name('notes.show');
        Route::get('/assignments', [StudentController::class, 'assignments'])->name('assignments');
        Route::get('/assignments/{assignment}', [StudentController::class, 'showAssignment'])->name('assignments.show');
        Route::post('/assignments/{assignment}/submit', [StudentController::class, 'submitAssignment'])->name('assignments.submit');
        Route::get('/tests', [StudentController::class, 'tests'])->name('tests');
        Route::get('/tests/{test}/start', [StudentController::class, 'startTest'])->name('tests.start');
        Route::post('/tests/{test}/submit', [StudentController::class, 'submitTest'])->name('tests.submit');
        Route::get('/attempts/{attempt}/result', [StudentController::class, 'testResult'])->name('tests.result');
    });

require __DIR__.'/auth.php';
