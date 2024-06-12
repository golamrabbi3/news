<?php

namespace App\Http\Requests\Api\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories', 'name')->ignore($this->category ?? null)
            ],
            'is_active' => 'required|boolean',
            'image' => 'image:jpg,jpeg,png|max:1024',
            'category_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}
