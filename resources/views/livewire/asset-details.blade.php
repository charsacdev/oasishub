<div>
    <style>
        .modal-title{
            color:#148727;
        }
        .form-label{
            color:#148727
        }
        .form-control{
            border:1px solid #148727
        }
    </style>
    <!-- Breadcrumb -->
    <div class="wpo-breadcumb-area" style="background:#252525;height:400px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>Details</h2>
                        <p class="text-light">{{ $asset->asset_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Asset Details Section -->
    <section class="wpo-destination-single-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="wpo-destination-single-wrap">
                        <div class="wpo-destination-single-content post format-gallery">
                            <!-- Slider -->
                            <div class="entry-media">
                                <div class="post-slider owl-carousel">
                                    @php
                                        $photos = json_decode($asset->asset_photos, true) ?? [];
                                    @endphp

                                    @foreach($photos as $photo)
                                        <img src="{{ asset($photo) }}" alt="{{ $asset->asset_name }}" class="img-fluid img-slide" style="width:100%; height:650px">
                                    @endforeach
                                </div>
                                <!--style-->
                                <style>
                                    @media screen and (max-width:640px){
                                        .img-slide{
                                            height:300px !important;
                                        }
                                    }
                                 </style>
                            </div>

                            <!-- Description -->
                            <div class="wpo-destination-single-content-des" style="border:0px solid green">
                                <h2>{{ $asset->asset_name }}</h2>
                                <p>{!! $asset->asset_description !!}</p>
                                 <!-- Book Now Button -->
                                <button wire:click="$set('showBookingModal', true)" 
                                        class="w-100 btn btn-primary shadow-none d-flex align-items-center justify-content-center" 
                                        style="height:50px;background-color:#148727;border:0px" 
                                        wire:loading.attr="disabled">
                                    
                                    <!-- Normal Text -->
                                    <span wire:loading.remove> 
                                        <i class="bi bi-calendar-check me-2"></i>Make Rquest
                                    </span>

                                    <!-- Loading Spinner -->
                                    <span wire:loading>
                                        <div class="spinner-border spinner-border-sm text-light me-2" role="status"></div>
                                        Processing...
                                    </span>
                                </button>

                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
           

        </div>

        
       
        <!-- Booking Form Modal -->
        @if($showBookingModal)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background:rgba(0,0,0,0.5)">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-3">
                        
                        <!-- Header -->
                        <div class="modal-header text-white">
                            <h5 class="modal-title">Ultimus Luxury New Request</h5>
                            <button type="button" class="btn-close btn-close-white" wire:click="$set('showBookingModal', false)" aria-label="Close"></button>
                        </div>
                        
                        <!-- Body -->
                        <div class="modal-body p-4">
                            <form wire:submit.prevent="bookAsset">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">First Name</label>
                                    <input type="text" wire:model="first_name" class="form-control shadow-sm" placeholder="Enter First Name" required>
                                    @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Last Name</label>
                                    <input type="text" wire:model="last_name" class="form-control shadow-sm" placeholder="Enter Last Name" required>
                                    @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" wire:model="email" class="form-control shadow-sm" placeholder="Enter Email Address" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Phone</label>
                                    <input type="text" wire:model="phone" class="form-control shadow-sm" placeholder="Enter Phone Number" required>
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Footer Buttons -->
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-light me-2" wire:click="$set('showBookingModal', false)">Cancel</button>
                                     <button type="submit" 
                                        class="btn btn-success d-flex align-items-center justify-content-center" 
                                        wire:loading.attr="disabled" 
                                        wire:target="bookAsset">

                                    <!-- Normal state -->
                                    <span wire:loading.remove wire:target="bookAsset">
                                        <i class="bi bi-check-circle me-1"></i> Submit
                                    </span>

                                    <!-- Loading state -->
                                    <span wire:loading wire:target="bookAsset">
                                        <div class="spinner-border spinner-border-sm text-light me-2" role="status"></div>
                                        Processing...
                                    </span>
                                </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif


        <!-- Custom Email Modal -->
       @if($showEmailModal)
        <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5)">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-3">

                    <!-- Header -->
                    <div class="modal-header text-white">
                        <h5 class="modal-title">New Request Created</h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="$set('showEmailModal', false)" aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-4 text-center">
                        <h6>Your Order Request code is:</h6>
                        <h3 class="fw-bold text-primary">{{ $bookingCode }}</h3>
                        <p class="text-muted">You can send an email with your booking details below:</p>

                        @php
                            $subject = urlencode("Request Confirmation: {$bookingCode}");
                            $body = urlencode("Hello,\n\nHere are my request details:\nRequest Code: {$bookingCode}\nAsset: {$asset->asset_name}\n\nThank you!");
                        @endphp

                        <!-- Mailto Button -->
                        <a href="mailto:support@luxuryultimusempire.com?subject={{ $subject }}&body={{ $body }}" 
                          class="btn btn-success w-100" target="_blank">
                           <i class="bi bi-envelope-fill me-2"></i> Send Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </section>


</div>
