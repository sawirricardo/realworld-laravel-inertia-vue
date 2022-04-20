<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleFeedController extends Controller
{
    public function __invoke()
    {
        return inertia('Feed', [
            'articles' => Article::query()
                ->with(['tags','user'])
                ->withCount(['comments','users'])
                ->whereBelongsTo(Auth::user()->users()->pluck('id'))
                ->latest()
                ->get(),
        ]);
    }
}
