<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    use ApiResponsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return $this->apiResponse($posts, 'Posts retrieved successfully', 200);    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $posts = new Post();
        $posts->title = $request->title;
        $posts->body = $request->body;
        $posts->save();
        return $this->apiResponse($posts, 'Post created successfully', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Post::find($id);
        if (!$posts) {
            return $this->apiResponse(null, 'Post not found', 404);
        }
        return $this->apiResponse($posts, 'Post retrieved successfully', 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posts = Post::find($id);
        if (!$posts) {
            return $this->apiResponse(null, 'Post not found', 404);
        }
        $posts->title = $request->title;
        $posts->body = $request->body;
        $posts->save();
        return $this->apiResponse($posts, 'Post updated successfully', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts = Post::find($id);
        if (!$posts) {
            return $this->apiResponse(null, 'Post not found', 404);
        }
        $posts->delete();
        return $this->apiResponse(null, 'Post deleted successfully', 200);

    }
}
