<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(60),
            'user_id' => User::inRandomOrder()->first()->id,
            'posted_at' => fake()->dateTime()->format('Y-m-d H:i:s'),

        ];
    }
}
