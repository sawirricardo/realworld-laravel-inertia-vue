<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        return inertia('Tag/Show', [
            'articles' => Article::with('tags')
                ->whereHas('tags', function ($query) use ($tag) {
                    $query->where('tags.id', $tag->getKey());
                })->get(),
            'tag' => $tag,
            'tags' => Tag::query()->get(),
            ]);
    }
}
