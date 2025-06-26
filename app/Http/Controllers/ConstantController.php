<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function showConstants(Request $request)
    {
        $lang = $request->query('lang', 'en');
        return view('constants', compact('lang'));
    }
}