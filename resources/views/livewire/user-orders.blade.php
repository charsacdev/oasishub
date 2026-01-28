<div>
    
   @if(!isset($OrderId))
        <div class="card shadow-lg rounded-4 m-0" style="height:100vh;">

            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa-solid fa-receipt"></i> Orders</h5>
            </div>

            <!-- Messages -->
            @if (session('success'))
                <div class="alert alert-success m-2">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger m-2">{{ session('error') }}</div>
            @endif


            <div class="card-body table-responsive" wire:ignore>
                <table id="ordersTable" class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr style="white-space: nowrap">
                            <th>S/n</th>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr style="white-space: nowrap">
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $order->order_id}}</td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($order->order_status == 'completed') bg-success
                                        @elseif($order->order_status == 'pending') bg-warning
                                        @else bg-danger @endif">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/orders?orders=' . encrypt($order->cart_id)) }}" 
                                            class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i> View Details
                                     </a>

                                  
                                    @if($order->order_status == 'confirmed')
                                        <button wire:loading.attr="disabled" class="btn btn-sm btn-success disabled">
                                            <i class="fa fa-check"></i> Confirmed
                                        </button>
                                    @elseif($order->order_status == 'declined')
                                        <button wire:loading.attr="disabled" class="btn btn-sm btn-danger disabled">
                                            <i class="fa fa-times"></i> Declined
                                        </button>
                                    @endif

                                    <button wire:click="delete({{ $order->id }})" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <p>No orders found.</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @else
           <!---ORDER DETAILS--->
            <div class="container py-5">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">
                            <i class="fa-solid fa-receipt me-2"></i> Order Details
                        </h4>
                    </div>

                    <div class="card-body p-4">
                        {{-- Order Summary --}}
                        <div class="row mb-4">
                            
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-sm me-2">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <h5 class="fw-bold mb-0">Customer Information</h5>
                            </div>

                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</li>
                                    <li><strong>Email:</strong> {{ $order->email }}</li>
                                    <li><strong>Phone:</strong> {{ $order->phone }}</li>
                                    <li><strong>Address:</strong> {{ $order->house_address }}, {{ $order->city }}, {{ $order->state }}</li>
                                    <li><strong>Country:</strong> {{ $order->country }}</li>
                                    <li><strong>Zip Code:</strong> {{ $order->zip_code }}</li>
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3">Order Information</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Order ID:</strong> {{ $order->order_id }}</li>
                                    <li><strong>Status:</strong> 
                                        <span class="badge 
                                            @if($order->order_status == 'pending') bg-warning 
                                            @elseif($order->order_status == 'completed') bg-success 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </li>
                                    <li><strong>Placed On:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</li>
                                </ul>
                            </div>
                        </div>

                        <hr>

                        {{-- Cart Items --}}
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-box me-2"></i> Items in this Order</h5>
                    
                        <ul class="list-group">
                            @php $total = 0; @endphp

                            @foreach ($order->cart as $cartItem)
                                @php
                                    $asset = $cartItem->product ?? null;
                                    $price = $asset->asset_price ?? 0;
                                    $quantity = (int) ($cartItem->quantity ?? 1);
                                    $subtotal = $price * $quantity;
                                    $total += $subtotal;
                                @endphp

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $asset->asset_name ?? 'Unknown Item' }}</h6>
                                        <small class="text-muted d-block">
                                            Category: {{ $asset->asset_category ?? 'N/A' }}
                                        </small>
                                        <small class="text-muted d-block">
                                            Quantity: {{ $quantity }}
                                        </small>
                                        <small class="text-muted d-block">
                                            Unit Price: ${{ number_format($price, 2) }}
                                        </small>
                                    </div>

                                    <div class="text-end">
                                        <strong>${{ number_format($subtotal, 2) }}</strong>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{-- 🧾 Total Summary --}}
                        <div class="mt-4 text-end border-top pt-3">
                            <h5 class="fw-bold mb-1">
                                <span class="text-muted">Total:</span> 
                                ${{ number_format($total, 2) }}
                            </h5>
                        </div>

                          @if($order->order_status == 'pending')
                            <button wire:loading.attr="disabled" wire:click="approve({{ $order }})" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i> Confirm
                            </button>
                            <button wire:loading.attr="disabled" wire:click="decline({{ $order }})" class="btn btn-sm btn-danger">
                                <i class="fa fa-times"></i> Decline
                            </button>
                        @endif


                    
                    </div>
                </div>
            </div>
        @endif
</div>
