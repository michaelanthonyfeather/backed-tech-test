<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Comment;

class CommentController extends Controller
{
    //Function to a dd a comment to a single blog
    public function addCommentToBlog(Request $request, Blog $blog)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email',
            'comment' => 'required|string',
        ]);

        $comment = new Comment;
        $comment->fill($request->all());
        $comment->blog_id = $blog->id;

        $comment->save();

        return response()->json([
            'message' => 'Comment added the the blog with an ID of ' . $blog->id,
            'data' => Blog::all(),
        ], 200);
    }

    //Function to update a single comment
    public function updateComment(Request $request, Comment $comment)
    {
        $this->validate(request(), [
            'title' => 'string',
            'name' => 'string',
            'email' => 'string|email',
            'comment_data' => 'string',
        ]);

        $comment->update([
            'title' => $request->title ? $request->title : $comment->title,
            'name' => $request->name ? $request->name : $comment->name,
            'email' => $request->email ? $request->email : $comment->email,
            'comment' => $request->comment_data ? $request->comment_data : $comment->comment,
        ]);

        return response()->json([
            'message' => 'Comment updated with an ID of ' . $comment->id,
            'data' => $comment,
        ], 200);
    }

    //Function to delete a comment
    public function deleteComment(Request $request, Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted with an ID of ' . $comment->id,
        ], 200);

    }
}
