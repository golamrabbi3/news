<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
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
            'hash_code' => 'required|string|max:255',
            'otp' => 'required|integer|between:100000,999999|hash_check:' . $this->hash_code,
        ];
    }

    public function messages(): array
    {
        return [
            'otp.integer' => __('The email verification OTP must be integer.'),
            'otp.between' => __('The email verification OTP is not correct.'),
            'otp.hash_check' => __('The email verification OTP is not correct.'),
        ];
    }
}
