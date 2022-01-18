<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategory extends FormRequest
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
            'name' => ['required', 'min:3', 'max:255', "unique:categories,name,{$uuid},uuid"],
            'description' => ['nullable', 'min:3', 'max:255'],
            'image' => ['nullable', 'min:3', 'max:255'],
            'slug' => ['nullable', 'min:3', 'max:255']
        ];
    }
}
