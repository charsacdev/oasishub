@component('mail::message')
# Hello {{ $order->first_name }},

@if($type=="approved")
We’re excited to let you know that your Orders has been **Approved**.
@else
We’re regret to inform you that your Orders has been **Declined**.
@endif

**Order Details:**
 <ul class="list-unstyled">
<li><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</li>
<li><strong>Email:</strong> {{ $order->email }}</li>
<li><strong>Phone:</strong> {{ $order->phone }}</li>
<li><strong>Address:</strong> {{ $order->house_address }}, {{ $order->city }}, {{ $order->state }}</li>
<li><strong>Country:</strong> {{ $order->country }}</li>
<li><strong>Zip Code:</strong> {{ $order->zip_code }}</li>
</ul>

### Items in your order

<div style="overflow-x:auto;">
    <table style="width:100%; border-collapse: collapse; border:1px solid #ddd; font-family: Arial, sans-serif; font-size:14px;">
        <thead>
            <tr style="background-color:#f8f8f8;">
                <th style="padding:8px; border:1px solid #ddd; text-align:left;">Name</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:left;">Category</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:right;">Price</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:right;">Quantity</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($items as $item)
                @php 
                    $subtotal = $item->quantity * $item->product->asset_price; 
                    $total += $subtotal;
                @endphp
                <tr>
                    <td style="padding:8px; border:1px solid #ddd;">{{ $item->product->asset_name }}</td>
                    <td style="padding:8px; border:1px solid #ddd;">{{ $item->product->asset_category }}</td>
                    <td style="padding:8px; border:1px solid #ddd; text-align:right;">${{ number_format($item->product->asset_price,2) }}</td>
                    <td style="padding:8px; border:1px solid #ddd; text-align:right;">{{ $item->quantity }}</td>
                    <td style="padding:8px; border:1px solid #ddd; text-align:right;">${{ number_format($subtotal,2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="padding:8px; border:1px solid #ddd; text-align:right; font-weight:bold;">Total:</td>
                <td style="padding:8px; border:1px solid #ddd; text-align:right; font-weight:bold;">${{ number_format($total,2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>


Thanks for choosing us,  
{{ config('app.name') }}
@endcomponent
