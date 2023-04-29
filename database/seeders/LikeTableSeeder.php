<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $l = new Like;
        $l->user_id = 1;
        $l->blog_post_id = 1;
        $l->comment_id = 1;
        $l->save();

        Like::factory()->count(250)->create();
    }
}
