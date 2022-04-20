<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        return inertia('Article/Index', [
            'articles' => Article::query()
                ->with(['tags','user'])
                ->withCount(['comments','users'])
                ->when(Auth::check(), function ($query) {
                    $query->withExists(['users' => function ($query) {
                        $query->where('user_id', Auth::user()->getKey());
                    },]);
                })
                ->latest()
                ->get(),
        ]);
    }

    public function create()
    {
        return inertia('Article/Create');
    }

    public function store()
    {
        request()->validate([
            'title' => ['required'],
            'content' => ['required'],
            'excerpt' => ['string'],
        ]);

        $article = Article::create([
            'title' => request('title'),
            'content' => request('content'),
            'excerpt' => request('excerpt'),
            'user_id' => Auth::user()->getKey(),
        ]);

        request()->whenFilled('tags', function () use ($article) {
            str(request('tags'))->split(',')->map(function ($tag) use ($article) {
                $article->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
            });
        });

        return redirect()->route('articles.edit', ['article' => $article]);
    }

    public function show(Article $article)
    {
        $article->loadCount(['users'])
            ->load([
                'tags',
                'user' => function ($query) {
                    $query->withCount('followers');
                    $query->when(Auth::check(), function ($query) {
                        $query->withExists([
                            'followers' => function ($query) {
                                $query->where('user_id', Auth::user()->getKey());
                            },
                        ]);
                    });
                },
                'comments.user',
                'users',
            ])
            ->when(Auth::check(), function ($article) {
                $article->loadExists([
                    'users' => function ($query) {
                        $query->where('user_id', Auth::user()->getKey());
                    },
                ]);
            });
        return inertia('Article/Show', ['article' => $article]);
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return inertia('Article/Edit', ['article' => $article]);
    }

    public function update(Article $article)
    {
        request()->validate([
            'title' => ['required'],
            'content' => ['required'],
            'excerpt' => ['string'],
        ]);

        $this->authorize('update', $article);

        $article->update([
            'title' => request('title'),
            'content' => request('content'),
            'excerpt' => request('excerpt'),
        ]);

        request()->whenHas('tags', function () use ($article) {
            $article->tags()->detach();

            request()->whenFilled('tags', function () use ($article) {
                str(request('tags'))->split(',')->map(function ($tag) use ($article) {
                    $article->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
                });
            });
        });

        return redirect()->route('articles.edit', ['article' => $article]);
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->to('/');
    }
}
