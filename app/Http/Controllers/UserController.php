<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        return view ('user', ['users' => $users]);
    }

    public function registeredUser()
    {
        $registeredUser = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('registered-user', ['registeredUser' => $registeredUser]);
    }

    public function view($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view ('user-detail', ['user' => $user]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('user-detail/'.$slug)->with('status', 'User Approved Successfully !');
    }
}
