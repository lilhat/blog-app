<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedBlogPost extends Model
{
    use HasFactory;

    protected $table = 'related_blog_posts';
    protected $fillable = [
        'blog_post_id',
        'related_blog_post_id'
    ];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
