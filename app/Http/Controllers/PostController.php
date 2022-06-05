<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(10);

        return response()->json([
            'posts' => $posts,
            'type' => 'success',
            'message' => 'Posts retrieved successfully',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $slug = Str::slug($request->title);
        $usersId = User::inRandomOrder()->first()->id;
        $data = [
            'title' => $request->title,
            'author' => $usersId,
            'slug' => $slug,
            'body' => $request->body,
            'image' => $request->image,
        ];
        $post = Post::create($data);
        return response()->json([
            'post' => $post,
            'type' => 'success',
            'message' => 'Post created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return response()->json([
            'post' => $post,
            'type' => 'success',
            'message' => 'Post retrieved successfully',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        return response()->json([
            'message' => 'Post updated successfully',
            'type' => 'success',
            'post' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::where('slug', $request->slug)->first();
        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully',
            'type' => 'success',
        ], 200);
    }
}
