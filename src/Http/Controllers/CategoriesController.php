<?php

namespace Optimus\Posts\Http\Controllers;

use Illuminate\Routing\Controller;
use Optimus\Posts\Models\PostCategory;
use Optimus\Posts\Http\Requests\CategoryRequest;
use Optimus\Posts\Http\Resources\Category as CategoryResource;

class CategoriesController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = PostCategory::orderBy('name', 'asc')->get();

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = new PostCategory();

        $category->name = $request->input('name');

        if ($request->filled('slug')) {
            $category->slug = $request->input('slug');
        }

        $category->save();

        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = PostCategory::findOrFail($id);

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = PostCategory::findOrFail($id);

        $category->name = $request->input('name');

        if ($request->filled('slug')) {
            $category->slug = $request->input('slug');
        }

        $category->save();

        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        PostCategory::findOrFail($id)->delete();

        return response(null, 204);
    }
}
