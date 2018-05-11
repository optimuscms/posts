<?php

namespace Optimus\Posts\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostComment extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
