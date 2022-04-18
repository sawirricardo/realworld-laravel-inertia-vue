<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Article $article)
    {
        request()->validate([
            'content' => ['required'],
        ]);
        $article->comments()->create([
            'content' => request('content'),
            'user_id' => Auth::user()->getKey(),
        ]);

        return redirect()->back();
    }

    public function update(Comment $comment)
    {
        request()->validate([
            'content' => ['required'],
        ]);

        $comment->update([
            'content' => request('content'),
        ]);
        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
