@component('mail::message')
@if($for === 'user')
# Hello {{ $preorder->name }},

We’ve received your pre-order request! 🎉  
Our team will review it shortly.

@component('mail::panel')
**Product Name:** {{ $preorder->product_name }}  
**Category:** {{ $preorder->product_category }}  
**Description:** {{ $preorder->product_description ?? 'N/A' }}
@endcomponent

Thanks for choosing us,  
**{{ config('app.name') }}**


@else
# New Pre-order Received 🛒

A new pre-order has been submitted by **{{ $preorder->name }}**.

@component('mail::panel')
**Email:** {{ $preorder->email }}  
**Category:** {{ $preorder->product_category }}  
**Product:** {{ $preorder->product_name }}  
**Description:** {{ $preorder->product_description ?? 'N/A' }}
@endcomponent

@endif
@endcomponent
