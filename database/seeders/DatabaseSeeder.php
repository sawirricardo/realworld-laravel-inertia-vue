<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->has(Article::factory(10)->has(Comment::factory(10)))->create();

        Tag::create(['name' => 'PHP']);
        Tag::create(['name' => 'Javascript']);
        Tag::create(['name' => 'Python']);
        Tag::create(['name' => 'HTML']);
    }
}
