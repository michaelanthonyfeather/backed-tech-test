<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;

class BlogController extends Controller
{
    //Function to get all BLogs
    public function getBlogs()
    {
        return response()->json([
            'message' => 'Received all Blogs',
            'data' => Blog::all(),
        ], 200);
    }

    //Function to get a single Blog with it's Comments
    public function getBlogWithComments(Blog $blog)
    {
        return response()->json([
            'message' => 'Received blog with an ID of ' . $blog->id . ' and all of its comments',
            'data' => ['blog' => $blog, 'comments' => $blog->comments],
        ], 200);

    }
}
