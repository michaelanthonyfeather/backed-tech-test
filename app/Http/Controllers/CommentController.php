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
    public function addCommentToBlog(Blog $blog)
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

        return json_encode('Success');
    }
}
