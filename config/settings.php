<?php

return [
    'general-settings' => [
        'app_name' => [
            'input_type' => 'text',
            'input_label' => 'App Name',
            'placeholder' => 'Enter App Name',
            'default' => env('APP_NAME'),
            'validation' => [
                'rules' => 'required|max:255',
                'messages' => null,
                'attribute' => 'application name',
            ],
        ],
        'support_email' => [
            'input_type' => 'email',
            'input_label' => 'Support Email',
            'placeholder' => 'Enter Support Email',
            'default' => null,
            'validation' => [
                'rules' => 'required|email|max:255',
                'messages' => null,
                'attribute' => null,
            ],
        ],
    ],

    'contact-information' => [
        'contact_number' => [
            'input_type' => 'text',
            'input_label' => 'Contact Mobile Number',
            'placeholder' => 'Enter Mobile Number',
            'default' => null,
            'validation' => [
                'rules' => 'nullable|max:255',
                'messages' => null,
                'attribute' => 'mobile number',
            ],
        ],
        'contact_address' => [
            'input_type' => 'text',
            'input_label' => 'Contact Address',
            'placeholder' => 'Enter Contact Address',
            'default' => null,
            'validation' => [
                'rules' => 'nullable|max:255',
                'messages' => null,
                'attribute' => 'contact address',
            ],
        ],
        'contact_email' => [
            'input_type' => 'email',
            'input_label' => 'Support Email',
            'placeholder' => 'Enter Support Email',
            'default' => null,
            'validation' => [
                'rules' => 'required|email|max:255',
                'messages' => null,
                'attribute' => 'contact email',
            ],
        ],
    ],

    'google-recaptcha' => [
        'display_google_captcha' => [
            'input_type' => 'radio',
            'input_label' => 'Google Captcha Protection',
            'placeholder' => 'Toggle Google Captcha',
            'default' => false,
            'options' => [],
            'validation' => [
                'rules' => 'nullable|max:255',
                'messages' => [],
                'attribute' => 'mobile number',
            ],
        ],
    ]
];
