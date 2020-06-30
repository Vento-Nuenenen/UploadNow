<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverwatchController extends Controller
{
    public function index()
    {
        return view('overwatch.overwatch');
    }
}
