<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index(Request $request)
    {
        return view('rentlog');
    }
}
