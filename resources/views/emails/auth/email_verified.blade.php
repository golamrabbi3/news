@component('mail::message')
# {{ __('Hello') }}, {{ $name }}

{{ __('Congratulation! You email address has been verified successfully on :appName platform.', ['appName' => config('app.name')]) }}

{{ __('Thanks a lot for being with us,') }}

{{ config('app.name') }}
@endcomponent
