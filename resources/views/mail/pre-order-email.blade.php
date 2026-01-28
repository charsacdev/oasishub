@component('mail::message')
# Hello {{ $order->name }},

@if($type=="approved")
We’re excited to let you know that your Pre Order has been **Approved**.
@else
We’re regret to inform you that your  Pre Order has been **Declined**.
@endif

**Pre Order Details:**
 <ul class="list-unstyled">
    <li><strong>Name:</strong> {{ $order->name }}</li>
    <li><strong>Email:</strong> {{ $order->email }}</li>
    <li><strong>Product Category:</strong> {{  $order->product_category }}</li>
    <li><strong>product Name:</strong>  {{ $order->product_name }}</li>
    <li><strong>Description:</strong>
        <p> {{ $order->product_description }}</p>
    </li>
    <li><strong>Placed On:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</li>

</ul>


Thanks for choosing us,  
{{ config('app.name') }}
@endcomponent
