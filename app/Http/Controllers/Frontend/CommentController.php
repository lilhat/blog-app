<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use App\Models\BlogPost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'content' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'bool' => false,
                ]);
            }
            $post = BlogPost::where('id', $request->blog_post_id)
                ->where('status', '0')
                ->first();
            if ($post) {
                $comment = new Comment();
                $comment->content = $request->content;
                $comment->user_id = Auth::user()->id;
                $comment->blog_post_id = $request->blog_post_id;
                date_default_timezone_set("Europe/London");
                $comment->posted_at = date('y-m-d h:i:s');
                $comment->save();
                return response()->json([
                    'bool' => true,
                ]);
            }
        } else {
            return response()->json([
                'bool' => false,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $comment = Comment::where('id', $request->comment_id)
                ->where('user_id', Auth::user()->id)
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
}
