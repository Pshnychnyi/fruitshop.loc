<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        return [
            'slug' => 'required|min:3|max:100',
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:100',
            'first_link_name' => 'nullable|min:3|max:20',
            'first_link_path' => 'nullable|integer|exists:menus,id',
            'second_link_name' => 'nullable|min:3|max:20',
            'second_link_path' => 'nullable|integer|exists:menus,id',
        ];
    }
}
