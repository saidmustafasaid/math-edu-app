<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\AngleController;
use Illuminate\Http\Request;
use App\Http\Controllers\ConversionController; // Import your controller


// Route::get('/', function () {
//     return view('welcome');
// });

// 👇✅ Your converter project routes
Route::get('/converter', [ConversionController::class, 'index'])->name('converter');
Route::post('/convert', [ConversionController::class, 'convert'])->name('convert');
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator');
Route::get('/formulas', [FormulaController::class, 'index'])->name('formulas');

Route::get('/home', function(Request $request) {
    $lang = $request->input('lang', 'en');
    return view('home', compact('lang'));
})->name('home');

Route::get('/constants', function (Request $request) {
    $lang = $request->query('lang', 'en');  // default to English if no lang parameter
    return view('constants', compact('lang'));
});

Route::get('angles', function (\Illuminate\Http\Request $request) {
    $lang = $request->query('lang', 'en');
    return view('angles', compact('lang'));
})->name('angles');


//Route::get('/angles', [AngleController::class, 'show'])->name('angles');


Route::get('/calculator', function () {
    $lang = request('lang', 'en'); // default 'en' if not set
    return view('scientific_calculator', compact('lang'));
})->name('calculator');


Route::get('/', function() {
    return redirect()->route('home');
});


// Breeze & Auth routes (keep them here)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
