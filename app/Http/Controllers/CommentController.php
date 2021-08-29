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
    public function addCommentToBlog(Request $request, Blog $blog)
    {
        if (!$blog)
        {
            return json_encode('Failed');
        }

        $this->validate(request(), [
            'title' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email',
            'comment' => 'required|string',
            'blog_id' => 'required|integer',
        ]);

        $comment = new Comment;
        $comment->fill($request->all());
        $comment->save();

        return json_encode('Success');
    }

    public function updateComment(Request $request, Comment $comment)
    {
        if (!$comment)
        {
            return json_encode('Failed');
        }

        $this->validate(request(), [
            'title' => 'string',
            'name' => 'string',
            'email' => 'string|email',
            'comment' => 'string',
        ]);

        $comment->update([
            'title' => $request->title ? $request->title : $comment->title,
            'name' => $request->name ? $request->name : $comment->name,
            'email' => $request->email ? $request->email : $comment->email,
            'comment' => $request->comment ? $request->comment : $comment->comment,
        ]);

        return json_encode('Success');
    }

    public function deleteComment(Request $request, Comment $comment)
    {
        if ($comment)
        {
            $comment->delete();

            return json_encode('Success');
        }
        else
        {
            return json_encode('Failed');
        }
    }
}
