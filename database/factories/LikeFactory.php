<?php

namespace Database\Factories;


use App\Models\User;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $blogPost = BlogPost::inRandomOrder()->first();
        $comment = $blogPost->comments()->inRandomOrder()->first();

        return [

            'user_id' => User::inRandomOrder()->first()->id,
            'blog_post_id' => $blogPost->id,
            'comment_id' => $comment ? $comment->id : null,
        ];
    }
}
