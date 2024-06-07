@component('mail::message')
# {{ __('Hello') }}, {{ $name }}

{{ __('Please use the following OTP to verify your email address on :appName platform.', ['appName' => config('app.name')]) }}

{{ $OTP }}

{{ __("The above OTP is validated only for 30 minutes.") }}

{{ __("If this action is not done by you, please ignore this email.") }}

{{ __('Thanks a lot for being with us,') }}

{{ config('app.name') }}
@endcomponent
