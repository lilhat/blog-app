<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'status',
        'user_id',

    ];

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'category_post');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
