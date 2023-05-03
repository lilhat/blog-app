<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }
    public function viewCategoryPost($category_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', 0)->first();
        if($category)
        {
            $post = BlogPost::where('category_id', $category->id)->where('status', '0')->paginate(3);
            return view('frontend.post.index', compact('post','category'));

        }
        else
        {
            return redirect('/');
        }
    }

    public function viewPost(string $category_slug, string $post_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', 0)->first();
        if($category)
        {
            $post = BlogPost::where('category_id', $category->id)->where('slug', $post_slug)->where('status', '0')->first();
            $latest_posts = BlogPost::where('category_id', $category->id)->where('status', '0')->orderBy('created_at', 'DESC')->get()->take(5);
            return view('frontend.post.view', compact('post','latest_posts', 'category'));

        }
        else
        {
            return redirect('/');
        }
    }
}
