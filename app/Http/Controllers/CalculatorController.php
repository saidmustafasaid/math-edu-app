<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->input('lang', 'en'); // default to English if not provided
        return view('scientific_calculator', compact('lang'));
    }
}
