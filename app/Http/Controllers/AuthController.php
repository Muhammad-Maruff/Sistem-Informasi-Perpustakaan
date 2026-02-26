<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function registerProcess(Request $request)
    {
        // tentukan validasi input user
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'phone' => 'max:255',
            'address' => 'required',
        ]);
        // enkripsi password 
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());
        // notif register berhasil 
        Session::flash('status', 'success');
        Session::flash('message', 'Registrasi berhasil, silahkan menunggu admin untuk di approval !');
        return redirect('register');
    }


    
    public function authenticating(Request $request)
    {
        // menampung input user
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // cek apakah login valid
        if (Auth::attempt($credentials)) {
            // cek apakah status = active || jika status inactive
            if (Auth::user()->status != 'active')
            {
            // paksa keluar jika status inactive 
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            // notif jika akun inactive
                Session::flash('status', 'failed');
                Session::flash('message', 'Akun anda belum aktif. Silahkan hubungi admin !');
                return redirect('login');
            }
            // regenerate session 
            $request->session()->regenerate();
            // cek jika login sebagai admin ke halaman dashboard 
            if(Auth::user()->role_id == 1){
                return redirect('dashboard');
            }
            // cek jika login sebagai client ke halaman profile
            if(Auth::user()->role_id == 2){
                return redirect ('profile');
            }
        }
        // jika username & password tidak sesuai 
        Session::flash('status', 'failed');
        Session::flash('message', 'Email atau password yang anda masukkan salah !');
        return redirect('login');
    }

    public function logout(Request $request)
    {
        // fitur logout 
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
