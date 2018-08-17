<?php

namespace Optimus\Posts\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Post extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->firstMedia(),
            'slug' => $this->slug,
            'body' => $this->body,
            'categories' => Category::collection($this->categories),
            'published_at' => (string) $this->published_at,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
