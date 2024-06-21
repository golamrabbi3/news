<?php

namespace App\Http\Requests\Api\News;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
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
            'description' => 'required|max:3000',
            'comment_id' => Rule::exists('comments', 'id')
                ->where(function (Builder $query) {
                    return $query
                        ->where('commentable_type', get_class($this->news))
                        ->where('commentable_id', $this->news->id)
                        ->whereNull('comment_id');
                }),
        ];
    }
}
