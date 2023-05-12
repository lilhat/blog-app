<?php

namespace App\Http\Controllers\Author;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\BlogPostFormRequest;
use Illuminate\Support\Str;
use App\Services\TwitterService;


class BlogPostController extends Controller
{

    protected $twitterService;

    public function __construct(TwitterService $twitterService)
    {
        $this->twitterService = $twitterService;
    }
    public function index()
    {
        $posts = BlogPost::all();
        return view('author.post.index', compact('posts'));

    }

    public function create()
    {
        $category = Category::where('status', '0')->get();
        $posts = BlogPost::all();
        return view('author.post.create', compact('category','posts'));

    }
    public function store(BlogPostFormRequest $request)
    {
        $data = $request->validated();

        $post = new BlogPost;
        $post->title = $data['title'];
        $post->slug = Str::slug($data['slug']);
        $post->content = $data['content'];

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/', $filename);
            $post->image = $filename;
        }

        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        $post->status = $request->status == true ? '1':'0';
        $post->user_id = Auth::user()->id;

        $post->save();
        $post->categories()->attach($data['category_id']);

        $this->twitterService->postTweet($post);

        if (!empty($data['related_post_id'])) {
            $relatedPost = BlogPost::find($data['related_post_id']);
            if ($relatedPost) {
                $post->relatedBlogPost()->create([
                    'blog_post_id' => $post->id,
                    'related_blog_post_id' => $relatedPost->id
                ]);
            }
        }

        return redirect('author/posts')->with('message', 'Blog Post Added Successfully');


    }

    public function edit($post_id)
    {
        $category = Category::where('status','0')->get();
        $post = BlogPost::find($post_id);
        $posts = BlogPost::all();
        return view('author.post.edit', compact('post','category','posts'));
    }

    public function update(BlogPostFormRequest $request, $post_id)
    {
        $data = $request->validated();

        $post = BlogPost::find($post_id);
        $post->title = $data['title'];
        $post->slug = Str::slug($data['slug']);
        $post->content = $data['content'];

        if($request->hasfile('image')){

            $destination = 'uploads/post/'.$post->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/', $filename);
            $post->image = $filename;
        }

        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        $post->status = $request->status == true ? '1':'0';
        $post->user_id = Auth::user()->id;

        $post->update();

        $post->categories()->sync($data['category_id']);


        if (!empty($data['related_post_id'])) {
            $relatedPost = BlogPost::find($data['related_post_id']);
            if ($relatedPost) {
                if($post->relatedBlogPost){
                    $post->relatedBlogPost()->update([
                    'blog_post_id' => $post->id,
                    'related_blog_post_id' => $relatedPost->id
                ]);
                } else {
                    $post->relatedBlogPost()->create([
                    'blog_post_id' => $post->id,
                    'related_blog_post_id' => $relatedPost->id
                    ]);
                }

            }
        }

        return redirect('author/posts')->with('message', 'Blog Post Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $post = BlogPost::find($request->post_delete_id);
        if($post)
        {
            $destination = 'uploads/post/'.$post->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $post->delete();
            return redirect('author/posts')->with('message', 'Post Deleted Successfully');
        }
        else
        {
            return redirect('author/posts')->with('message', 'Post not found');
        }
    }
}
