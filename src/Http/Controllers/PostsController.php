<?php

namespace Optimus\Posts\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Optimus\Posts\Models\Post;
use Illuminate\Routing\Controller;
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

    public function store(Request $request)
    {
        $this->validate($request);

        $post = new Post();

        $post->title = $request->input('title');

        if ($request->filled('slug')) {
            $post->slug = $request->input('slug');
        }

        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');

        $post->published_at = Carbon::parse(
            $request->input('published_at')
        );

        $post->save();

        $post->categories()->attach(
            $request->input('categories')
        );

        $post->attachMedia(
            $request->input('image_id'), 'image',
            config('post.image_conversions')
        );

        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::withDrafts()->findOrFail($id);

        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request);

        $post = Post::withDrafts()->findOrFail($id);

        $post->title = $request->input('title');

        if ($request->filled('slug')) {
            $post->slug = $request->input('slug');
        }

        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');

        $post->published_at = Carbon::parse(
            $request->input('published_at')
        );

        $post->save();

        $post->categories()->sync(
            $request->input('categories')
        );

        $post->syncMedia(
            $request->input('image_id'), 'image',
            config('post.image_conversions')
        );

        return new PostResource($post);
    }

    public function destroy(Request $request, $id)
    {
        Post::withDrafts()
            ->findOrFail($id)
            ->delete();

        return response(null, 204);
    }

    protected function validate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image_id' => 'required|exists:media,id',
            'categories' => 'required|exists:post_categories,id',
            'excerpt' => 'required',
            'body' => 'required',
            'published_at' => 'required|date'
        ]);
    }
}
