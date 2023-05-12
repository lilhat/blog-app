<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use App\Models\Category;
use App\Models\BlogPost;
use App\Models\Like;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\CommentFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\CommentLiked;
use App\Notifications\CommentReplied;
use App\Events\CommentSuccess;
use Response;

class CommentController extends Controller
{
    public function store(CommentFormRequest $request)
    {
        if (Auth::check()) {
            $commentable = BlogPost::where('id', $request->blog_post_id)
                ->where('status', '0')
                ->first();
            if ($commentable) {
                $comment = new Comment();
                $comment->content = $request->content;
                $comment->user_id = Auth::user()->id;
                date_default_timezone_set('Europe/London');
                $comment->posted_at = date('Y-m-d h:i:s');
                $commentable->comments()->save($comment);
                if ($commentable->user_id !== Auth::id()) {
                    $category = $commentable->categories->first();
                    $slug = '/section/' . $category->slug . '/' . $commentable->slug;
                    User::find($commentable->user_id)->notify(new CommentReplied(Auth::user()->name, $slug));
                }
                event(new CommentSuccess($commentable->title));
                return response()->json([
                    'bool' => true,
                    'comment' => $comment,
                ]);
            } else {
                return response()->json([
                    'bool' => false,
                    'message' => 'Post not found',
                ]);
            }
        } else {
            return response()->json([
                'bool' => false,
                'message' => 'Must be logged in',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $comment = Comment::where('id', $request->comment_id)
                ->first();

            if ($comment) {
                $comment->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment Deleted Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Error',
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Must be logged in to delete comment',
            ]);
        }
    }

    public function replyStore(CommentFormRequest $request)
    {
        if (Auth::check()) {
            $parent_comment = Comment::where('id', $request->parent_id)->first();
            if ($parent_comment) {
                $commentable = BlogPost::where('id', $request->blog_post_id)
                    ->where('status', '0')
                    ->first();
                if ($commentable) {
                    $comment = new Comment();
                    $comment->content = $request->content;
                    $comment->parent_id = $request->parent_id;
                    $comment->user_id = Auth::user()->id;
                    date_default_timezone_set('Europe/London');
                    $comment->posted_at = date('Y-m-d h:i:s');
                    $commentable->comments()->save($comment);
                    $parent_comment = Comment::find($comment->parent_id);
                    if ($parent_comment->user_id !== Auth::user()->id) {
                        $category = $commentable->categories->first();
                        $slug = '/section/' . $category->slug . '/' . $commentable->slug;
                        User::find($parent_comment->user_id)->notify(new CommentReplied(Auth::user()->name, $slug));
                    }
                    event(new CommentSuccess($comment->user->name));
                    return response()->json([
                        'bool' => true,
                        'comment' => $comment,
                    ]);
                } else {
                    return response()->json([
                        'bool' => false,
                        'message' => 'Post not found'
                    ]);
                }
            } else {
                return response()->json([
                    'bool' => false,
                    'message' => 'Comment not found'
                ]);
            }
        } else {
            return response()->json([
                'bool' => false,
                'message' => 'Must be logged in'
            ]);
        }
    }


    public function likeStore(Request $request)
    {
        if (Auth::check()) {
            $post = BlogPost::where('id', $request->blog_post_id)
                ->where('status', '0')
                ->first();
            if ($post) {
                $comment = Comment::where('id', $request->comment_id)
                ->first();
                $like = new Like();
                $like->comment_id = $request->comment_id;
                $like->user_id = Auth::user()->id;
                $like->blog_post_id = $request->blog_post_id;
                $like->save();
                if ($comment->user_id !== Auth::user()->id) {
                    $category = $post->categories->first();
                    $slug = '/section/' . $category->slug . '/' . $post->slug;
                    User::find($comment->user_id)->notify(new CommentLiked(Auth::user()->name, $slug));
                }
                return response()->json([
                    'bool' => true,
                    'count' => count($comment->likes),
                ]);
            } else {
                return response()->json([
                    'bool' => false,
                    'message' => 'Post not found',
                ]);
            }
        } else {
            return response()->json([
                'bool' => false,
                'message' => 'Must be logged in',
            ]);
        }
    }

    public function likeDestroy(Request $request)
    {
        if (Auth::check()) {
            $post = BlogPost::where('id', $request->blog_post_id)
                ->where('status', '0')
                ->first();
            if ($post) {
                $comment = Comment::where('id', $request->comment_id)
                ->first();
                if($comment)
                {
                    $like = like::where('comment_id', $request->comment_id)
                    ->where('user_id', Auth::user()->id)
                    ->first();
                    $like->delete();
                    return response()->json([
                        'bool' => true,
                        'count' => count($comment->likes),
                    ]);
                } else {
                    return response()->json([
                        'bool' => false,
                        'message' => 'Comment not found',
                    ]);
                }
            } else {
                return response()->json([
                    'bool' => false,
                    'message' => 'Post not found',
                ]);
            }
        } else {
            return response()->json([
                'bool' => false,
                'message' => 'Must be logged in',
            ]);
        }
    }


    public function update(CommentFormRequest $request)
    {
        if (Auth::check()) {
            $comment = Comment::where('id', $request->comment_id)->first();
            if ($comment) {

                $comment->content = $request->content;
                $comment->update();
                return response()->json([
                    'bool' => true,
                    'message' => 'Comment updated successfully',
                ]);

            } else {
                return response()->json([
                    'bool' => false,
                    'message' => 'Comment not found',
                ]);
            }

        } else {
            return response()->json([
                'bool' => false,
                'message' => 'Must be logged in',
            ]);
        }
    }
}
