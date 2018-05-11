<?php

namespace Optimus\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Optimus\Posts\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::withDrafts()->all();

        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $this->validatePost($request);

        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'author_id' => $request->input('author_id'),
            'published_at' => $request->input('published_at')
        ]);

        // Todo: Save images.

        if (! empty($tags = $request->input('tags'))) {
            $post->tags()->attach($tags);
        }

        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::withDrafts()->findOrFail($id);

        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::withDrafts()->findOrFail($id);

        $this->validatePost($request);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'author_id' => $request->input('author_id'),
            'published_at' => $request->input('published_at')
        ]);

        // Todo: Sync images.

        $post->tags()->sync($request->input('tags'));

        return response(null, 204);
    }

    public function destroy($id)
    {
        Post::withDrafts()->findOrFail($id)->delete();

        return response(null, 204);
    }

    protected function validatePost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required|string',
            'author_id' => 'exists:admin_users,id|nullable',
            'tags' => 'required|array',
            'tags.*' => 'exists:post_tags,id',
            'published_at' => 'required|date',
        ]);
    }
}
