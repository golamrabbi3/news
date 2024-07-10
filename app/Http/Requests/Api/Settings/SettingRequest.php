<?php

namespace App\Http\Requests\Api\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public array $settingRules;
    public array $settingMessages;
    public array $settingAttributes;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $section = config('settings.' . $this->section);

        foreach ($section as $attribute => $configurations) {
            $this->settingRules[$attribute] = $configurations['validation']['rules'];
            $this->settingMessages[$attribute] = $configurations['validation']['messages'];
            $this->settingAttributes[$attribute] = $configurations['validation']['attribute'];
        }

        return true;
    }

    public function rules(): array
    {
        return $this->settingRules;
    }

    public function messages(): array
    {
        return $this->settingMessages;
    }

    public function attributes(): array
    {
        return $this->settingAttributes;
    }
}
