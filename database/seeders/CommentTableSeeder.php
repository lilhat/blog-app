<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = new Comment;
        $c->content = "Very useful post! Will be using these tips in my next build.";
        $c->author_id = 1;
        $c->blog_post_id = 1;
        $c->posted_at = "2023-03-02 12:10:03";
        $c->save();

        Comment::factory()->count(100)->create();
    }
}
