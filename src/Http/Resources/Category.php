<?php

namespace Optimus\Posts\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Category extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->body,
            'slug' => $this->slug,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
