<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return inertia('Session/Create');
    }

    public function store()
    {
        request()->validate([
            'email' =>['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(request(['email', 'password']))) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'message' => 'Please check your credentials and try again.',
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
