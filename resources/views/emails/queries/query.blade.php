@component('mail::message')
# {{ __('Hello Admin') }}

{{ __("You got a new query! An user just has sent an query through app query form - ") }}


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
