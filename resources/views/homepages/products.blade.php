@extends('homepages.header')
@section('content')

        <main class="main">
            <div class="category-banner-container bg-gray">
                <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('{{asset('assets-2/images/elements/page-header.jpg')}}');">
                    <div class="container position-relative">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav text-white">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                        </nav>
                        <h1 class="page-title text-center text-white">Products</h1>
                    </div>
                </div>
            </div>

        
            <div class="container mt-6">
                <h4 class="text-uppercase heading-bottom-border">Product's Category</h4>

                <div class="creative-grid grid">
                   @php
                        // Pick one random product
                        $product = $products->shuffle()->first();

                        // Decode photos
                        $photos = is_array($product->asset_photos) ? $product->asset_photos : json_decode($product->asset_photos, true);
                        $firstPhoto = $photos[0] ?? "{{asset('assets-2/images/products/placeholder.jpg')}}";

                        #dd($photos);
                    @endphp

                    <div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark w-50 grid-height-1 w-md-100">
                        <figure>
                            <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                <img src="{{ asset($firstPhoto) }}" alt="{{ $product->asset_name }}" width="576" height="576">
                            </a>
                            <div class="label-group">
                                @if(!empty($product->discount))
                                    <span class="product-label label-sale">{{ $product->discount }}% Off</span>
                                @endif
                            </div>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-icon-wish">
                                    <i class="icon-heart"></i>
                                </a>
                                <button class="btn-icon btn-add-cart product-type-simple" data-toggle="modal" data-target="#addCartModal">
                                    <i class="icon-shopping-cart"></i>
                                </button>
                            </div>
                            {{-- <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}" class="btn-quickview" title="Quick View">
                                Quick View
                            </a> --}}
                        </figure>

                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="#" class="product-category">{{ $product->asset_category }}</a>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                    {{ $product->asset_name }}
                                </a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">${{ number_format($product->asset_price, 2) }}</span>
                            </div>
                        </div>
                    </div>


                   <!--================PRODUCT 2==================-->
                   @php
                        // Pick one random product
                        $product = $products->shuffle()->first();

                        // Decode photos
                        $photos = is_array($product->asset_photos) ? $product->asset_photos : json_decode($product->asset_photos, true);
                        $firstPhoto = $photos[0] ?? "{{asset('assets-2/images/products/placeholder.jpg')}}";

                        #dd($photos);
                    @endphp

                    <div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark w-25 grid-height-1 w-md-100">
                        <figure>
                            <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                <img src="{{ asset($firstPhoto) }}" alt="{{ $product->asset_name }}" width="300" height="300">
                            </a>
                            <div class="label-group">
                                @if(!empty($product->discount))
                                    <span class="product-label label-sale">{{ $product->discount }}% Off</span>
                                @endif
                            </div>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-icon-wish">
                                    <i class="icon-heart"></i>
                                </a>
                                <button class="btn-icon btn-add-cart product-type-simple" data-toggle="modal" data-target="#addCartModal">
                                    <i class="icon-shopping-cart"></i>
                                </button>
                            </div>
                            {{-- <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}" class="btn-quickview" title="Quick View">
                                Quick View
                            </a> --}}
                        </figure>

                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="#" class="product-category">{{ $product->asset_category }}</a>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                    {{ $product->asset_name }}
                                </a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">${{ number_format($product->asset_price, 2) }}</span>
                            </div>
                        </div>
                    </div>


                  <!--===============PRODUCT 3==================-->
                   @php
                        // Pick one random product
                        $product = $products->shuffle()->first();

                        // Decode photos
                        $photos = is_array($product->asset_photos) ? $product->asset_photos : json_decode($product->asset_photos, true);
                        $firstPhoto = $photos[0] ?? "{{asset('assets-2/images/products/placeholder.jpg')}}";

                        #dd($photos);
                    @endphp

                    <div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark w-25 grid-height-1-2 w-md-50 w-xs-100">
                        <figure>
                            <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                <img src="{{ asset($firstPhoto) }}" alt="{{ $product->asset_name }}" width="300" height="300">
                            </a>
                            <div class="label-group">
                                @if(!empty($product->discount))
                                    <span class="product-label label-sale">{{ $product->discount }}% Off</span>
                                @endif
                            </div>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-icon-wish">
                                    <i class="icon-heart"></i>
                                </a>
                                <button class="btn-icon btn-add-cart product-type-simple" data-toggle="modal" data-target="#addCartModal">
                                    <i class="icon-shopping-cart"></i>
                                </button>
                            </div>
                            {{-- <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}" class="btn-quickview" title="Quick View">
                                Quick View
                            </a> --}}
                        </figure>

                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="#" class="product-category">{{ $product->asset_category }}</a>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                    {{ $product->asset_name }}
                                </a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">${{ number_format($product->asset_price, 2) }}</span>
                            </div>
                        </div>     
                    </div>

                  <!--================PRODUCT 4==================-->
                   @php
                        // Pick one random product
                        $product = $products->shuffle()->first();

                        // Decode photos
                        $photos = is_array($product->asset_photos) ? $product->asset_photos : json_decode($product->asset_photos, true);
                        $firstPhoto = $photos[0] ?? "{{asset('assets-2/images/products/placeholder.jpg')}}";

                        #dd($photos);
                    @endphp

                    <div class="product-default grid-item inner-quickview inner-icon inner-icon-inline overlay-dark w-25 grid-height-1-2 w-md-50 w-xs-100">
                        <figure>
                            <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                <img src="{{ asset($firstPhoto) }}" alt="{{ $product->asset_name }}" width="300" height="300" >
                            </a>
                            <div class="label-group">
                                @if(!empty($product->discount))
                                    <span class="product-label label-sale">{{ $product->discount }}% Off</span>
                                @endif
                            </div>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-icon-wish">
                                    <i class="icon-heart"></i>
                                </a>
                                <button class="btn-icon btn-add-cart product-type-simple" data-toggle="modal" data-target="#addCartModal">
                                    <i class="icon-shopping-cart"></i>
                                </button>
                            </div>
                            {{-- <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}" class="btn-quickview" title="Quick View">
                                Quick View
                            </a> --}}
                        </figure>

                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="#" class="product-category">{{ $product->asset_category }}</a>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                    {{ $product->asset_name }}
                                </a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">${{ number_format($product->asset_price, 2) }}</span>
                            </div>
                        </div>
                          
                    </div>
                    <div class="grid-col-sizer"></div>
                </div>

                <h4 class="text-uppercase heading-bottom-border mt-6">Links on image</h4>
                <div class="row">
                  @foreach ($products->shuffle() as $product)
                    <div class="col-6 col-sm-4 col-md-3">
                        <div class="product-default inner-btn inner-icon inner-icon-inline left-details">
                            <figure>
                                <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">
                                    @php
                                        $photos = json_decode($product->asset_photos, true) ?? [];
                                    @endphp

                                    @if(count($photos) > 0)
                                        <img src="{{ asset($photos[0]) }}" width="280" height="280" style="width:280px;height:280px" alt="{{ $product->asset_name }}">
                                    @endif

                                    @if(count($photos) > 1)
                                        <img src="{{ asset($photos[1]) }}" width="280" height="280" style="width:280px;height:280px" alt="{{ $product->asset_name }}">
                                    @endif
                                </a>

                                {{-- ✅ Dynamic Label --}}
                                @if ($product->asset_type === 'new arrivals')
                                    <div class="label-group">
                                        <div class="product-label bg-info">NEW</div>
                                    </div>
                                @elseif ($product->asset_type === 'hot deals')
                                    <div class="label-group">
                                        <div class="product-label bg-danger">HOT</div>
                                    </div>
                                @elseif ($product->asset_type === 'featured product')
                                    <div class="label-group">
                                        <div class="product-label bg-success">FEATURED</div>
                                    </div>
                                @endif

                                <div class="btn-icon-group">
                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                                    <a href="#" class="btn-icon btn-icon-wish product-type-simple" title="wishlist"><i class="icon-heart"></i></a>
                                    <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}" class="btn-icon btn-quickview" title="Quick View">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </figure>

                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="#" class="product-category">{{ ucfirst($product->asset_category) }}</a>
                                    </div>
                                </div>

                                <h3 class="product-title">
                                    <a href="{{ url('/product-details/' . Crypt::encrypt($product->id)) }}">{{ Str::limit($product->asset_name, 30) }}</a>
                                </h3>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{ rand(70, 100) }}%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>

                                <div class="price-box">
                                    <span class="product-price">${{ number_format($product->asset_price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <!-- End .row -->

			</div>

			
		</main><!-- End .main -->

	@endsection