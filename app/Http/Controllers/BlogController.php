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
    public function getBlogs()
    {
        return Blog::all()->toJson();
    }

    public function getBlogWithComments($blog)
    {
        $blog = Blog::where('id', $blog)->with('comments')->first();

        if ($blog)
        {
            return $blog->toJson();
        }
        else
        {
            return json_encode('Failed');
        }
    }
}
