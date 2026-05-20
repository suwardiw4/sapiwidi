<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            //return back();
            return redirect()->route('dashboard');
        }

        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Auth::check()) {
                // dd('coba');
                return back();
            }

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                // return redirect()->intended('dashboard');
                return redirect()->route('dashboard');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah',
            ])->onlyInput('email');
        }

        return view('pages.auth.login');
    }

        public function logout(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
