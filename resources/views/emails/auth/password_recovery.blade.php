@component('mail::message')
# {{ __('Hello') }}, {{ $name }}

{{ __('Please use the following OTP to recover your account password on :appName platform.', ['appName' => config('app.name')]) }}

{{ $OTP }}

{{ __("If it's not you please ignore this email.") }}

{{ __('Thanks a lot for being with us,') }}

{{ config('app.name') }}
@endcomponent
