<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = $this->route()->parameter('product') ? $this->route()->parameter('product') : '';
        return [
            'title' => 'required|min:3|max:100|string|unique:products,title, '. $id,
            'description' => 'required|string|min:3',
            'price' => 'numeric|min:1',
            'cats' => 'required|array',
            'cats.*' => 'nullable|integer|exists:categories,id',
            'relates' => 'nullable|array',
            'relates.*' => 'nullable|integer',
            'img' => 'image|nullable',
            'per' => 'string|nullable',
        ];
    }
}

/*|in:1кг,500г,100г*/
