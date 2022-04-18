<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return inertia('User/Create');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required','unique:users,name'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','confirmed'],
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        Auth::login($user);

        return redirect()->to('/');
    }

    public function show($name)
    {
        return inertia('User/Show', [
            'user' => User::query()->where('name', $name)->firstOrFail(),
        ]);
    }

    public function edit()
    {
        return inertia('User/Edit');
    }

    public function update()
    {
        request()->validate([
            'name' => ['required'],
            'email' => ['required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore(Auth::user()->getKey()),
            ],
            'avatar_url' => ['active_url'],
            'bio' => ['string'],
        ]);
        return ;
    }

    public function destroy()
    {
        return;
    }
}
