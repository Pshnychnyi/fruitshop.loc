<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        $id = $this->route()->parameter('team') ? $this->route()->parameter('team') : '';
        return [
            'title' => 'required|min:3|max:50|unique:reviews,title, '. $id,
            'profession' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:255',
            'img'=> 'image'
        ];
    }
}
