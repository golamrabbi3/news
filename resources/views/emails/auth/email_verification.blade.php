@component('mail::message')
    # {{ __('Hello') }}, {{ $name }}

    {{ __('Please use the following OTP to verify your email address on :appName platform.', ['appName' => config('app.name')]) }}

    {{ $OTP }}

    {{ __('Thanks a lot for being with us,') }}

    {{ config('app.name') }}
@endcomponent
