<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $all_categories = Category::where('status','0')->get();
        $latest_posts = BlogPost::where('status', '0')->orderBy('created_at', 'DESC')->get()->take(4);
        return view('frontend.index', compact('all_categories', 'latest_posts'));
    }

    public function viewCategoryPost($category_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', 0)->first();
        if($category)
        {
            $post = BlogPost::whereHas('categories', function ($query) use ($category) {
                        $query->where('categories.id', $category->id);
                    })
                    ->where('status', '0')
                    ->paginate(3);
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
            $post = BlogPost::whereHas('categories', function ($query) use ($category) {
                        $query->where('categories.id', $category->id);
                    })
                    ->where('slug', $post_slug)
                    ->where('status', '0')
                    ->first();
            $latest_posts = BlogPost::whereHas('categories', function($query) use ($category) {
                                $query->where('categories.id', $category->id);
                            })->where('status', '0')
                            ->orderBy('created_at', 'DESC')
                            ->take(4)
                            ->get();

            if($post->relatedBlogPost)
            {
                $related_post = BlogPost::find($post->relatedBlogPost->id);

            }
            else{
                $related_post = false;
            }
            return view('frontend.post.view', compact('post','latest_posts', 'category', 'related_post'));

        }
        else
        {
            return redirect('/');
        }
    }

    public function viewUser(int $user_id)
    {
        $user = User::where('id', $user_id)->first();
        if($user)
        {
            $post = BlogPost::where('user_id', $user->id)->where('status', '0')->latest()->get();
            $comment = Comment::where('user_id', $user->id)->latest();
            return view('frontend.user', compact('user','post','comment'));

        }
        else
        {
            return redirect('/');
        }
    }
}
