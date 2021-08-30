<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Please make BLOG & COMMENT CRUD ROUTES
*/

Route::get('/blogs', [BlogController::class, 'getBlogs']);

Route::get('/blog/{blog}', [BlogController::class, 'getBlogWithComments'])
        ->missing(function (Request $request) {
            return response()->json([
                'message' => 'No blog was found with an ID of ' . $request->blog,
            ], 404);
        });

Route::post('/blog/{blog}/comment', [CommentController::class, 'addCommentToBlog'])
        ->missing(function (Request $request) {
            return response()->json([
                'message' => 'No blog was found with an ID of ' . $request->blog,
            ], 404);
        });

Route::put('/update-comment/{comment}', [CommentController::Class, 'updateComment'])
        ->missing(function (Request $request) {
            return response()->json([
                'message' => 'No comment was found with an ID of ' . $request->comment,
            ], 404);
        });

Route::delete('/delete-comment/{comment}', [CommentController::Class, 'deleteComment'])
        ->missing(function (Request $request) {
            return response()->json([
                'message' => 'No comment was found with an ID of ' . $request->comment,
            ], 404);
        });
