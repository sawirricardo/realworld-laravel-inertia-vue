<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function store()
    {
        Follower::firstOrCreate([
            'user_id' => request('user_id'),
            'follower_id' => Auth::user()->getKey(),
        ]);
        return redirect()->back();
    }

    public function destroy()
    {
        Follower::query()->where([
            'user_id' => request('user_id'),
            'follower_id' => Auth::user()->getKey(),
        ])->firstOrFail()->deleteOrFail();
        return redirect()->back();
    }
}
