<?php

namespace Optimus\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Optimus\Posts\PostTag;

class PostTagsController extends Controller
{
    public function index()
    {
        $tags = PostTag::all();

        return PostTagResource::collection($tags);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:post_tags'
        ]);

        $tag = PostTag::create([
            'name' => $request->input('name')
        ]);

        return new PostTagResource($tag);
    }

    public function show($id)
    {
        $tag = PostTag::findOrFail($id);

        return new PostTagResource($tag);
    }

    public function update(Request $request, $id)
    {
        $tag = PostTag::findOrFail($id);

        $request->validate([
            'name' => [
                'required|string',
                Rule::unique('post_tags')->ignore($id)
            ]
        ]);

        $tag->update(['name' => $request->input('name')]);

        return response(null, 204);
    }

    public function destroy($id)
    {
        PostTag::findOrFail($id)->delete();

        return response()->setStatusCode(204);
    }
}
