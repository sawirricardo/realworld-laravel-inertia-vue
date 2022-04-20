<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
        $user = User::query()
            ->withCount('followers')
            ->with(['articles' => function ($query) {
                $query->with(['user','tags']);
                $query->withCount(['users','comments']);
            },])
            ->where('name', $name)
            ->firstOrFail();

        return inertia('User/Show', [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        return inertia('User/Edit', [
            'user' => Auth::user(),
        ]);
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
        return redirect()->route('user.edit');
    }

    public function destroy()
    {
        Auth::logout();
        Auth::user()->delete();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('users.create');
    }
}
