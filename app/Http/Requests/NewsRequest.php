<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameter('news') ? $this->route()->parameter('news') : '';

        return [
            'title' => 'required|min:3|unique:categories,title, ' . $id,
            'content' => 'required|min:6',
            'img' => 'image',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|integer',
            'preview_text' => 'nullable|string|max:200',
            'preview_image' => 'nullable|image'
        ];
    }
}
