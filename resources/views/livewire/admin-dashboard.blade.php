<div>

    @if(!isset($OrderId))
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3 col-6">
                    <div class="card card-stat p-3 text-center">
                        <i class="fa-solid fa-cloud-arrow-up stat-icon mb-2"></i>
                        <p>Total Uploads</p>
                        <h3 class="fw-bold">{{ $stats['uploads'] }}</h3>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="card card-stat p-3 text-center">
                        <i class="fa-solid fa-circle-check stat-icon mb-2"></i>
                        <p>Completed Orders</p>
                        <h3 class="fw-bold">{{ $stats['completed'] }}</h3>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="card card-stat p-3 text-center">
                        <i class="fa-solid fa-hourglass-half stat-icon mb-2"></i>
                        <p>Pending Orders</p>
                        <h3 class="fw-bold">{{ $stats['pending'] }}</h3>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="card card-stat p-3 text-center">
                        <i class="fa-solid fa-cart-arrow-down stat-icon mb-2"></i>
                        <p>Pre-Orders</p>
                        <h3 class="fw-bold">{{ $stats['preorders'] }}</h3>
                    </div>
                </div>

        </div>

        <!-- Recent Bookings Table -->
        <div class="table-custom">
            <h5 class="mb-3 table-h">Recent Orders</h5>
            <div class="table-responsive">
                <table id="bookingsTable" class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Order Code</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                <td>{{ $booking->order_id}}</td>
                                <td>{{ $booking->email}}</td>
                                <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($booking->order_status == 'completed') bg-success
                                        @elseif($booking->order_status == 'pending') bg-warning text-dark
                                        @else bg-danger @endif">
                                        {{ ucfirst($booking->order_status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/dashboard?orders=' . encrypt($booking->cart_id)) }}" 
                                            class="btn btn-sm btn-success">
                                                <i class="fa fa-edit"></i> View
                                     </a>
                                </td>
                            </tr>
                        @endforeach
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


                   
                </div>
            </div>
        </div>
        @endif

</div>
