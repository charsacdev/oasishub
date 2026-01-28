@component('mail::message')
# Password Reset Request

Hi {{ $user->first_name }},

We received a request to reset your password for **Oasis Vista Hub**.  
Click the button below to set a new password:

@component('mail::button', ['url' => $resetUrl])
Reset My Password
@endcomponent

If you didn’t request this, please ignore this email.

Thanks,  
{{ config('app.name') }}
@endcomponent
