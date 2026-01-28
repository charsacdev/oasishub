<div>
    
   @if(!isset($OrderId))
        <div class="card shadow-lg rounded-4 m-0" style="height:100vh;">

            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa-solid fa-receipt"></i>Pre Orders</h5>
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
                            <th>User</th>
                            <th>Email</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr style="white-space: nowrap">
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->product_category }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($order->status == 'approved') bg-success
                                        @elseif($order->status == 'pending') bg-warning
                                        @else bg-danger @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/preorder?orders=' . encrypt($order->id)) }}" 
                                            class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i> View Details
                                     </a>

                                  
                                 
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
                            <i class="fa-solid fa-receipt me-2"></i>Pre Order Details
                        </h4>
                    </div>

                    <div class="card-body p-4">
                        {{-- Order Summary --}}
                        <div class="row mb-4">
                            
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-sm me-2">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <h5 class="fw-bold mb-0">Pre Order Information</h5>
                            </div>

                            <div class="col-md-6">
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
                            </div>

                         
                        </div>

                        <hr>

                        {{-- Cart Items --}}
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-box me-2"></i> Pre-Order Images</h5>
                    
                        <ul class="list-group">
                    
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="mt-2 d-flex flex-wrap gap-2">
                                        @php
                                            $photos = is_string($order->product_image)
                                                ? json_decode($order->product_image, true)
                                                : $order->product_image;
                                        @endphp

                                        @if(!empty($photos) && is_array($photos))
                                            @foreach($photos as $photo)
                                                <img src="{{ asset($photo) }}" alt="Preview" class="img-thumbnail" style="width:120px;height:100px;object-fit:cover;">
                                            @endforeach
                                        @else
                                            <p>No images available.</p>
                                        @endif
                                    </div>
                                </li>
                            
                        </ul>

                          @if($order->status == 'pending')
                          <div class="mt-4 p-2">
                                <button wire:loading.attr="disabled" wire:click="approve({{ $order }})" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Confirm
                                </button>
                                <button wire:loading.attr="disabled" wire:click="decline({{ $order }})" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i> Decline
                                </button>
                          </div>
                        @endif
                    
                    </div>
                </div>
            </div>
        @endif
</div>
