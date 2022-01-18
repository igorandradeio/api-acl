<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduct extends FormRequest
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

        $uuid = $this->uuid ?? '';

        return [
            'name' => ['required', 'min:3', 'max:255', "unique:products,name,{$uuid},uuid"],
            'category' => ['required', 'exists:categories,uuid'],
            'description' => ['nullable', 'min:3', 'max:255'],
            'image' => ['nullable', 'min:3', 'max:255'],
            'slug' => ['nullable', 'min:3', 'max:255']
        ];
    }
}
