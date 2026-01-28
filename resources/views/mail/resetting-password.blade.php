@component('mail::message')
# Password Reset Request

We received a request to reset your password for **Ultimus Luxury Empire**.

Click the button below to reset your password:

@component('mail::button', ['url' => $url])
Reset My Password
@endcomponent

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
