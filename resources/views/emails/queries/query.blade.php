@component('mail::message')
# {{ __('Hello Admin') }}

{{ __("You've just received an query message - ") }}


| Client's Inforamtion          |                                   |
| ----------------------------- | --------------------------------- |
| {{ __("Name") }}              | {{ $query->fullName }}            |
| {{ __("Email Address") }}     | {{ $query->email }}               |
| {{ __("Mobile Contact") }}    | {{ $query->mobile_contact }}      |
| {{ __("Address") }}           | {{ $query->address ?? '-' }}      |
| {{ __("Subject") }}           | {{ $query->subject }}             |
| {{ __("Message") }}           | {{ $query->message }}             |


{{ __('Thanks a lot,') }}

{{ config('app.name') }}
@endcomponent
