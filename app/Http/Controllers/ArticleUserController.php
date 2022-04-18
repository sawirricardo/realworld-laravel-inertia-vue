<?php

namespace App\Http\Controllers;

use App\Models\ArticleUser;

class ArticleUserController extends Controller
{
    public function store()
    {
        ArticleUser::firstOrCreate([
            'article_id' => request('article_id'),
            'user_id' => request('user_id'),
        ]);
        return redirect()->back();
    }

    public function destroy()
    {
        ArticleUser::query()->where([
            'article_id' => request('article_id'),
            'user_id' => request('user_id'),
        ])->firstOrFail()->deleteOrFail();
        return redirect()->back();
    }
}
