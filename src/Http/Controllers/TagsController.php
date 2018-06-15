<?php

namespace Optimus\Posts\Http\Controllers;

use Optimus\Posts\PostTag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Optimus\Posts\Http\Resources\Tag as TagResource;

class TagsController extends Controller
{
    public function index()
    {
        $tags = PostTag::orderBy('name', 'asc')->all();

        return TagResource::collection($tags);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $tag = PostTag::create($request->all());

        return new TagResource($tag);
    }

    public function show($id)
    {
        $tag = PostTag::findOrFail($id);

        return new TagResource($tag);
    }

    public function update(Request $request, $id)
    {
        $tag = PostTag::findOrFail($id);

        $request->validate(['name' => 'required']);

        $tag->update($request->all());

        return new TagResource($tag);
    }

    public function destroy($id)
    {
        PostTag::findOrFail($id)->delete();

        return response(null, 204);
    }
}
