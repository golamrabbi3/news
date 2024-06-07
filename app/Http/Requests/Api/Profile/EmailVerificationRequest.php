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
        $cachedOTP = cache()->get("verification_" . $this->user()->email);

        return [
            'otp' => "required|integer|between:100000,999999|in:$cachedOTP",
        ];
    }

    public function messages(): array
    {
        return [
            'otp.integer' => __('The email verification OTP must be integer.'),
            'otp.between' => __('The email verification OTP is not correct.'),
            'otp.in' => __('The email verification OTP is not correct.'),
        ];
    }
}
