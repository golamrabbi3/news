@component('mail::message')
# {{ __('Hello') }}, {{ $name }}

{{ __(
    "You've just changed your account password on :appName platform. If it's not you please contact to our support center.",
    [
        'appName' => config('app.name'),
    ],
) }}

{{ __('Thanks a lot for being with us,') }}

{{ config('app.name') }}
@endcomponent
