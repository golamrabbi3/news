<?php

namespace App\Http\Requests\Api\Query;

use Illuminate\Foundation\Http\FormRequest;

class QueryRequest extends FormRequest
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
            'first_name' => "required|max:255",
            'last_name' => "required|max:255",
            'email' => "required|email:rfc,dns|max:255",
            'mobile_contact' => "required|numeric",
            'address' => "max:255",
            'subject' => "required|max:255",
            'message' => "required|max:3000",
        ];
    }
}
