<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('blog_post_id')->unsigned();

            $table->foreign('blog_post_id')->references('id')->on('blog_posts')
                ->onDelete('cascade')->onUpdate('cascade');


            $table->bigInteger('parent_id')->default('0');

            $table->foreign('parent_id')->references('id')->on('comments')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->datetime('posted_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
