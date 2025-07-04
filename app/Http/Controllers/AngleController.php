<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AngleController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'en');
        return view('angles', compact('lang'));
    }
}
