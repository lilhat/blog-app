<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';
    protected $fillable = [
        'blog_post_id',
        'user_id',
        'comment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
