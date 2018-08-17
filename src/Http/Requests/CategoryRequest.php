<?php

namespace Optimus\Posts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasPermissionTo('manage posts');
    }

    public function rules()
    {
        return $this->isMethod('delete') ? [] : ['name' => 'required'];
    }
}
