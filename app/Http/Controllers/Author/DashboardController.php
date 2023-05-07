<?php

namespace App\Http\Controllers\Author;

use App\Models\BlogPost;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $posts = BlogPost::count();

        return view('author.dashboard', compact('categories','posts'));

    }
}
