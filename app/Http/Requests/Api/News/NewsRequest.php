<?php

namespace App\Http\Requests\Api\News;

use App\Helpers\NewsStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'categories' => "array|max:10",
            'categories.*' => "exists:categories,id",
            'tags' => "array|max:10",
            'tags.*' => "exists:tags,id",
            'featured_image' => "image:jpg,jpeg,png|max:1024",
        ];
    }
}
