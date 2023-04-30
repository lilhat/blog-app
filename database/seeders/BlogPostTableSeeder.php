<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $b = new BlogPost;
        $b->title = "Why should you use Blue Circle over any other brand of cement?";
        $b->content = "Blue Circle cement is a top-of-the-line product that offers exceptional quality and durability. Unlike other brands, Blue Circle cement is formulated with a unique blend of high-quality materials that ensure maximum strength and stability.
        Whether you're building a new home or renovating an existing one, Blue Circle cement is the perfect choice for all your construction needs. Its superior binding properties and resistance to weathering make it ideal for use in a wide range of applications, from foundations and walls to floors and roofs.
        So why settle for anything less than the best? Choose Blue Circle cement for your next construction project and experience the difference for yourself!";
        $b->author_id = 1;
        $b->posted_at = "2023-03-02 12:05:03";
        $b->save();

        BlogPost::factory()->count(5)->create();
    }
}
