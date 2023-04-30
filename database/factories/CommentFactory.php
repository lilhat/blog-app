<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $blogPost = BlogPost::inRandomOrder()->first();

        return [
            'content' => fake()->paragraph(20),
            'user_id' => User::inRandomOrder()->first()->id,
            'blog_post_id' => $blogPost->id,
            'posted_at' => fake()->dateTimeBetween($blogPost->posted_at),
        ];
    }
}
