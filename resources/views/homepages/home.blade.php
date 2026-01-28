@extends('homepages.header')
@section('content')
    <main class="main">
        <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
                    'loop': true, 
                    'nav': true,
                    'dots': false,
                    'autoplay': true,
                    'autoplayTimeout': 5000 
                }">
                <div class="home-slide home-slide1 banner">
                    <img class="slide-bg" src="assets-2/images/demoes/demo4/slider/slide-1.jpg" width="1903" height="499" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 class="text-transform-none m-b-3">Find the Boundaries. Push Through!</h4>
                            <h2 class="text-transform-none mb-0">Summer Sale</h2>
                            <h3 class="m-b-3">70% Off</h3>
                            <h5 class="d-inline-block mb-0">
                                <span>Starting At</span>
                                <b class="coupon-sale-text text-white bg-secondary align-middle"><sup>$</sup><em
										class="align-text-top">199</em><sup>99</sup></b>
                            </h5>
                            <a href="/products" class="btn btn-dark btn-lg">Shop Now!</a>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                </div>
                <!-- End .home-slide -->

                <div class="home-slide home-slide1 banner">
                    <img class="slide-bg" style="background-color: #fff;" src="assets-2/images/demoes/demo4/slider/gadgets.jpg" width="1903" height="499" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 class="text-transform-none m-b-3 text-dark">Amazing offers on gadget sales. Push Through!</h4>
                            <h2 class="text-transform-none mb-0">Summer Sale</h2>
                            <h3 class="m-b-3">20% Off</h3>
                            <h5 class="d-inline-block mb-0">
                                <span>Starting At</span>
                                <b class="coupon-sale-text text-white bg-secondary align-middle"><sup>$</sup><em
										class="align-text-top">399</em><sup>99</sup></b>
                            </h5>
                            <a href="/products" class="btn btn-dark btn-lg">Shop Now!</a>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                </div>

                 <div class="home-slide home-slide2 banner banner-md-vw">
                    <img class="slide-bg" style="background-color: #ccc;" width="1903" height="499" src="assets-2/images/demoes/demo4/slider/kitchen.png" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer d-flex justify-content-center appear-animate" data-animation-name="fadeInUpShorter">
                            <div class="mx-auto">
                                <h4 class="m-b-1 text-dark">Extra on Kitchen wares and utensiles</h4>
                                <h3 class="m-b-2">40% off</h3>
                                <h3 class="mb-2 heading-border">Hot deals and offers</h3>
                                <h2 class="text-transform-none m-b-4">Summer Sale</h2>
                                <a href="/products" class="btn btn-block btn-dark">Shop All Sale</a>
                            </div>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                </div>
                

                <div class="home-slide home-slide2 banner banner-md-vw">
                    <img class="slide-bg" style="background-color: #ccc;" width="1903" height="499" src="assets-2/images/demoes/demo4/slider/slide-2.jpg" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer d-flex justify-content-center appear-animate" data-animation-name="fadeInUpShorter">
                            <div class="mx-auto">
                                <h4 class="m-b-1 text-dark">Extra</h4>
                                <h3 class="m-b-2">20% off</h3>
                                <h3 class="mb-2 heading-border">Fashion wares</h3>
                                <h2 class="text-transform-none m-b-4">Summer Sale</h2>
                                <a href="/products" class="btn btn-block btn-dark">Shop All Sale</a>
                            </div>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                </div>
                <!-- End .home-slide -->
            </div>
            <!-- End .home-slider -->

            <div class="container">
                <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
					'dots': false,
					'loop': true,
                    'autoplay': true,
                    'autoplayTimeout': 5000,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
                    <div class="info-box info-box-icon-left">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>FREE SHIPPING &amp; RETURN</h4>
                            <p class="text-body">Free shipping on all orders over $99.</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-money"></i>

                        <div class="info-box-content">
                            <h4>MONEY BACK GUARANTEE</h4>
                            <p class="text-body">100% money back guarantee</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>ONLINE SUPPORT 24/7</h4>
                            <p class="text-body">Dedicated support team for instant replies.</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->
                </div>
                <!-- End .info-boxes-slider -->

                <div class="banners-container mb-2">
                    <div class="banners-slider owl-carousel owl-theme" data-owl-options="{
						'dots': false
					}">
                        <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                            <figure class="w-100">
                                <img src="assets-2/images/demoes/demo4/banners/banner-1.jpg" alt="banner" width="380" height="175" />
                            </figure>
                            <div class="banner-layer">
                                <h3 class="m-b-2">Porto Watches</h3>
                                <h4 class="m-b-3 text-primary"><sup class="text-dark"><del>20%</del></sup>30%<sup>OFF</sup></h4>
                                <a href="#" class="btn btn-sm btn-dark">Shop Now</a>
                            </div>
                        </div>
                        <!-- End .banner -->

                        <div class="banner banner2 banner-sm-vw text-uppercase d-flex align-items-center appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="200">
                            <figure class="w-100">
                                <img src="assets-2/images/demoes/demo4/banners/banner-2.jpg" style="background-color: #ccc;" alt="banner" width="380" height="175" />
                            </figure>
                            <div class="banner-layer text-center">
                                <div class="row align-items-lg-center">
                                    <div class="col-lg-7 text-lg-right">
                                        <h3>Deal Promos</h3>
                                        <h4 class="pb-4 pb-lg-0 mb-0 text-body">Starting at $99</h4>
                                    </div>
                                    <div class="col-lg-5 text-lg-left px-0 px-xl-3">
                                        <a href="#" class="btn btn-sm btn-dark">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .banner -->

                        <div class="banner banner3 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                            <figure class="w-100">
                                <img src="assets-2/images/demoes/demo4/banners/banner-3.jpg" alt="banner" width="380" height="175" />
                            </figure>
                            <div class="banner-layer text-right">
                                <h3 class="m-b-2">Handbags</h3>
                                <h4 class="m-b-2 text-secondary text-uppercase">Starting at $99</h4>
                                <a href="#" class="btn btn-sm btn-dark">Shop Now</a>
                            </div>
                        </div>
                        <!-- End .banner -->
                    </div>
                </div>
            </div>
            <!-- End .container -->

          
             <section class="new-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">Featured Product</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
						'dots': false,
						'nav': true,
						'responsive': {
							'992': {
								'items': 4
							},
							'1200': {
								'items': 5
							}
						}
					}">
                        @foreach($featured as $item)
                                @php
                                   
                                   $photos = json_decode($item->asset_photos, true) ?? [];
                                    // Encrypt the product ID
                                    $encryptedId = encrypt($item->id);
                                @endphp

                                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                                    <figure>
                                        <a href="{{ url('product-details/' . $encryptedId) }}">
                                            <img src="{{ asset($photos[0]) }}" width="200" height="200" style="width:200px;height:200px" alt="{{ $item->asset_title }}">
                                            <img src="{{ asset($photos[1] ?? asset($photos[0])) }}" width="200" height="200" style="width:200px;height:200px" alt="{{ $item->asset_title }}">
                                        </a>
                                        @if(strtolower($item->asset_type) == 'hot deal')
                                            <div class="label-group">
                                                <div class="product-label bg-danger">HOT</div>
                                            </div>
                                        @elseif(strtolower($item->asset_type) == 'new arrivals')
                                            <div class="label-group">
                                                <div class="product-label bg-info">NEW</div>
                                            </div>
                                        @elseif(strtolower($item->asset_type) == 'featured product')
                                            <div class="label-group">
                                                <div class="product-label bg-success">FEATURED</div>
                                            </div>
                                        @endif
                                    </figure>

                                    <div class="product-details">
                                        <div class="category-list">
                                            <a href="{{ url('product-details/' . $encryptedId) }}" class="product-category">
                                                <span class="">{{ strtoupper($item->asset_category) }}</span>
                                            </a>
                                        </div>

                                        <h3 class="product-title">
                                            <a href="{{ url('product-details/' . $encryptedId) }}">{{ $item->asset_name }}</a>
                                        </h3>

                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{ rand(70, 100) }}%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>

                                        <div class="price-box">
                                            @if(!empty($item->old_price))
                                                <del class="old-price">${{ number_format($item->old_price, 2) }}</del>
                                            @endif
                                            <span class="product-price">${{ number_format($item->asset_price, 2) }}</span>
                                        </div>

                                        <div class="product-action">
                                          
                                            <a href="{{ url('product-details/' . $encryptedId) }}" class="btn-icon btn-add-cart">
                                                <i class="fa fa-arrow-right"></i><span>VIEW DETAILS</span>
                                            </a>
                                           
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                      
                    </div>
                </div>
            </section>


            <!--=================NEW ARRIVALS===================-->
            <section class="new-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">New Arrivals</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
						'dots': false,
						'nav': true,
						'responsive': {
							'992': {
								'items': 4
							},
							'1200': {
								'items': 5
							}
						}
					}">
                        @foreach($new as $item)
                                @php
                                   
                                   $photos = json_decode($item->asset_photos, true) ?? [];
                                    // Encrypt the product ID
                                    $encryptedId = encrypt($item->id);
                                @endphp

                                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                                    <figure>
                                        <a href="{{ url('product-details/' . $encryptedId) }}">
                                            <img src="{{ asset($photos[0]) }}" width="200" height="200" style="width:200px;height:200px" alt="{{ $item->asset_title }}">
                                            <img src="{{ asset($photos[1] ?? asset($photos[0])) }}" width="200" height="200" style="width:200px;height:200px" alt="{{ $item->asset_title }}">
                                        </a>

                                        @if(strtolower($item->asset_type) == 'hot deal')
                                            <div class="label-group">
                                                <div class="product-label bg-danger">HOT</div>
                                            </div>
                                        @elseif(strtolower($item->asset_type) == 'new arrivals')
                                            <div class="label-group">
                                                <div class="product-label bg-info">NEW</div>
                                            </div>
                                        @elseif(strtolower($item->asset_type) == 'featured product')
                                            <div class="label-group">
                                                <div class="product-label bg-success">FEATURED</div>
                                            </div>
                                        @endif
                                    </figure>

                                    <div class="product-details">
                                        <div class="category-list">
                                            <a href="{{ url('product-details/' . $encryptedId) }}" class="product-category">
                                                <span class="">{{ strtoupper($item->asset_category) }}</span>
                                            </a>
                                        </div>

                                        <h3 class="product-title">
                                            <a href="{{ url('product-details/' . $encryptedId) }}">{{ $item->asset_name }}</a>
                                        </h3>

                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{ rand(70, 100) }}%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>

                                        <div class="price-box">
                                            @if(!empty($item->old_price))
                                                <del class="old-price">${{ number_format($item->old_price, 2) }}</del>
                                            @endif
                                            <span class="product-price">${{ number_format($item->asset_price, 2) }}</span>
                                        </div>

                                        <div class="product-action">
                                            
                                            <a href="{{ url('product-details/' . $encryptedId) }}" class="btn-icon btn-add-cart">
                                                <i class="fa fa-arrow-right"></i><span>VIEW DETAILS</span>
                                            </a>
                                           
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                      
                    </div>
                </div>
            </section>
            <!-- End .featured-proucts -->
            

                <!--================HOT DEALS==============-->
                <section class="new-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">HOT DEALS</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
						'dots': false,
						'nav': true,
						'responsive': {
							'992': {
								'items': 4
							},
							'1200': {
								'items': 5
							}
						}
					}">
                        @foreach($hot as $item)
                                @php
                                   
                                   $photos = json_decode($item->asset_photos, true) ?? [];
                                    // Encrypt the product ID
                                    $encryptedId = encrypt($item->id);
                                @endphp

                                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                                    <figure>
                                        <a href="{{ url('product-details/' . $encryptedId) }}">
                                            <img src="{{ asset($photos[0]) }}" width="200" height="200" style="width:200px;height:200px" alt="{{ $item->asset_title }}">
                                            <img src="{{ asset($photos[1] ?? asset($photos[0])) }}" width="200" height="200" style="width:200px;height:200px" alt="{{ $item->asset_title }}">
                                        </a>

                                        @if(strtolower($item->asset_type) == 'hot deals')
                                            <div class="label-group">
                                                <div class="product-label bg-danger">HOT</div>
                                            </div>
                                        @elseif(strtolower($item->asset_type) == 'new arrivals')
                                            <div class="label-group">
                                                <div class="product-label bg-info">NEW</div>
                                            </div>
                                        @elseif(strtolower($item->asset_type) == 'featured product')
                                            <div class="label-group">
                                                <div class="product-label bg-success">FEATURED</div>
                                            </div>
                                        @endif
                                    </figure>

                                    <div class="product-details">
                                        <div class="category-list">
                                            <a href="{{ url('product-details/' . $encryptedId) }}" class="product-category">
                                                <span class="">{{ strtoupper($item->asset_category) }}</span>
                                            </a>
                                        </div>

                                        <h3 class="product-title">
                                            <a href="{{ url('product-details/' . $encryptedId) }}">{{ $item->asset_name }}</a>
                                        </h3>

                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{ rand(70, 100) }}%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>

                                        <div class="price-box">
                                            @if(!empty($item->old_price))
                                                <del class="old-price">${{ number_format($item->old_price, 2) }}</del>
                                            @endif
                                            <span class="product-price">${{ number_format($item->asset_price, 2) }}</span>
                                        </div>

                                        <div class="product-action">
                                           
                                            <a href="{{ url('product-details/' . $encryptedId) }}" class="btn-icon btn-add-cart">
                                                <i class="fa fa-arrow-right"></i><span>VIEW DETAILS</span>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                      
                    </div>
                </div>
             </section>
                    

              <section class="new-products-section">
                <div class="container">
                    <div class="banner banner-big-sale appear-animate" 
                        data-animation-delay="200" 
                        data-animation-name="fadeInUpShorter"
                        style="background: #2A95CB center/cover url('assets-2/images/demoes/demo4/banners/preorder-banner.jpg');">

                        <div class="banner-content row align-items-center mx-0">
                            <div class="col-md-9 col-sm-8">
                                <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                                    <b class="d-inline-block mr-3 mb-1 mb-md-0">Pre-Order Now!</b> 
                                    Get exclusive access to upcoming and custom-made products 
                                    <small class="text-transform-none align-middle">
                                        Be the first to receive new arrivals before they hit the shelves.
                                    </small>
                                </h2>
                            </div>
                            <div class="col-md-3 col-sm-4 text-center text-sm-right">
                                <a class="btn btn-light btn-white btn-lg" href="/preorder">
                                    Place Pre-Order
                                </a>
                            </div>
                        </div>
                    </div>


                    <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Browse Our Categories
                    </h2>

                    <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">
                        @foreach($categoryProduct as $item)
                            <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                                <a href="{{ url('/products/' . Crypt::encrypt($item->category_name)) }}">
                                    <figure>
                                        <img src="{{asset($item->category_image)}}" alt="category" width="200" height="240" style="width:200px;height:300px;object-fit:contain" />
                                    </figure>
                                    <div class="category-content">
                                        <h3>{{$item->category_name}}</h3>
                                        <span class="d-none"><mark class="count">3</mark> products</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>

            <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="assets-2/images/demoes/demo4/banners/banner-5.jpg">
                <div class="promo-banner banner container text-uppercase">
                    <div class="banner-content row align-items-center text-center">
                        <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
                            <h2 class="mb-md-0 text-white">Top Fashion<br>Deals</h2>
                        </div>
                        <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn" data-animation-delay="300">
                            <a href="/products" class="btn btn-dark btn-black ls-10">View Sale</a>
                        </div>
                        <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="600">
                            <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                                <b>Exclusive
									COUPON</b></h4>
                            <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-white bg-secondary ls-n-10">$100</b> OFF</h5>
                        </div>
                    </div>
                </div>
            </section>

        </main>
       
@endsection