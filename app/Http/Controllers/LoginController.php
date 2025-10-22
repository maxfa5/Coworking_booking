<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' =>['required'],
            ]);
            $request->session()->forget(['success', 'error', 'message']);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return  back()->with([
                'success'=>'Вы успешно вошли из системы.',
            ]);
        }
        return back()->withErrors([
            'error'=>'The provided credentials do not match our records.',
        ])->onlyInput('email', 'password');
    }
    
    public function login(Request $request){
        $request->session()->forget(['success', 'error', 'message']);

        return view('login', ['user' => Auth::user()]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return back()->withErrors('success', 'Вы успешно вышли из системы.');
    }
}