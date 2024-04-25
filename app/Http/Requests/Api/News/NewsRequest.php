<?php

namespace App\Http\Requests\Api\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use NewsStatus;

class NewsRequest extends FormRequest
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
            'title' => "required|string|max:255",
            'description' => "required|string|max:3000",
            'status' => [
                "required",
                Rule::enum(NewsStatus::class),
            ],
            'featured_image' => "image:jpg,jpeg,png|size:512",
            'categories' => "array|max:10",
            'tags' => "array|max:10",
        ];
    }
}
