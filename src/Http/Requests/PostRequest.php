<?php

namespace Optimus\Posts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasPermissionTo('manage posts');
    }

    public function rules()
    {
        return $this->isMethod('delete') ? [] : [
            'title' => 'required',
            'body' => 'required',
            'image' => 'exists:media,id|nullable',
            'categories' => 'required|array',
            'categories.*' => 'required|exists:post_categories,id',
            'published_at' => 'date|nullable'
        ];
    }
}
