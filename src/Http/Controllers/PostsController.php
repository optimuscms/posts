<?php

namespace Optimus\Posts\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Optimus\Posts\Models\Post;
use Illuminate\Routing\Controller;
use Optimus\Posts\Http\Requests\PostRequest;
use Optimus\Posts\Http\Resources\Post as PostResource;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::withDrafts()
            ->filter($request)
            ->get();

        return PostResource::collection($posts);
    }

    public function store(PostRequest $request)
    {
        $post = new Post();

        $post->title = $request->input('title');

        if ($request->filled('slug')) {
            $post->slug = $request->input('slug');
        }

        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');
        $post->schedule(Carbon::parse(
            $request->input('published_at')
        ));

        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::withDrafts()->findOrFail($id);

        return new PostResource($post);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::withDrafts()->findOrFail($id);

        $post->title = $request->input('title');

        if ($request->filled('slug')) {
            $post->slug = $request->input('slug');
        }

        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');
        $post->schedule(Carbon::parse(
            $request->input('published_at')
        ));

        return new PostResource($post);
    }

    public function destroy(PostRequest $request, $id)
    {
        Post::withDrafts()
            ->findOrFail($id)
            ->delete();

        return response(null, 204);
    }
}
