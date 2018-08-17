<?php

namespace Optimus\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Optimus\Posts\Models\PostCategory;
use Optimus\Posts\Http\Resources\Category as CategoryResource;

class CategoriesController extends Controller
{
    public function index()
    {
        $tags = PostCategory::orderBy('name', 'asc')->get();

        return CategoryResource::collection($tags);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $tag = PostCategory::create($request->all());

        return new CategoryResource($tag);
    }

    public function show($id)
    {
        $tag = PostCategory::findOrFail($id);

        return new CategoryResource($tag);
    }

    public function update(Request $request, $id)
    {
        $tag = PostCategory::findOrFail($id);

        $request->validate(['name' => 'required']);

        $tag->update($request->all());

        return new CategoryResource($tag);
    }

    public function destroy($id)
    {
        PostCategory::findOrFail($id)->delete();

        return response(null, 204);
    }
}
