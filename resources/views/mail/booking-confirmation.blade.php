@component('mail::message')
# Hello {{ $first_name }},

Thank you for your New Request! 🎉  

Here are your Request details:

- **Request Code:** {{ $bookingCode }}
- **Asset:** {{ $assetName }}
- **Status:** Pending

We will give you a follow up via email for payment details and request follow through.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
