<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RecoverRequest extends FormRequest
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
        $cachedOTP = cache()->get("recovery_" . $this->email);

        return [
            'email' => 'required|email:rfc,dns|max:255|exists:users,email',
            'otp' => "required|integer|between:100000,999999|in:$cachedOTP",
            'password' => [
                'required',
                Password::min(8)
                    ->max(255)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'otp.integer' => __('The password recovery OTP must be integer.'),
            'otp.between' => __('The password recovery OTP is not correct.'),
            'otp.in' => __('The password recovery OTP is not correct.'),
        ];
    }
}
