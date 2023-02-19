<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(Request $request)
    {
       return view('profile');
    }

    public function index(Request $request)
    {
        return view ('user');
    }
}
