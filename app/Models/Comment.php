<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
