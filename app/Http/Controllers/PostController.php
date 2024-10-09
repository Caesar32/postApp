<?php

namespace App\Http\Controllers;

use App\Models\Post; // Corrected to use capital 'P' for the Post model
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);

        // Create a new post with the validated data
        $posts = new Post();
        $posts->title = $request->title;
        $posts->body = $request->body;
        $posts->save();

        // Redirect to the index page after saving
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Return the view to display a single post
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Return the view to edit a specific post
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);

        // Update the post with the new data
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        // Redirect to the index page after updating
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete the post
        $post->delete();    
        // Redirect to the index page after deletion
        return redirect()->route('posts.index');
        
    }
}
