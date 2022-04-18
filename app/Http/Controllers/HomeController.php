<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;

class HomeController extends Controller
{
    public function __invoke()
    {
        return inertia('Home', [
            'articles' => Article::query()
            ->with(['tags','user'])
            ->withCount(['comments','users'])
            ->get(),
            'tags' => Tag::query()->get(),
        ]);
    }
}
