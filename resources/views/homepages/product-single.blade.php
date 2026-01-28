@extends('homepages.header')
@section('content')

<main class="main">
    <div class="container">

        <div class="product-single-container product-single-default">
            <div class="row">
                {{-- 🖼️ Product Images --}}
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container  p-3">
                        <div class="label-group">
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
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            @foreach ($photos as $photo)
                                <div class="product-item">
                                    <img class="product-single-image"
                                         src="{{ asset( $photo) }}"
                                          style="width:468px;height:468px"
                                         alt="{{ $product->asset_name }}">
                                </div>
                                <style>
                                    @media (max-width: 768px) {
                                        .product-single-image {
                                            height: 400px !important;
                                        }
                                    }
                                    </style>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 🛒 Product Details --}}
                <div class="col-lg-7 col-md-6 product-single-details  p-5">
                    <h1 class="product-title">{{ $product->asset_name }}</h1>

                    <div class="price-box">
                        @if(!empty($product->asset_old_price))
                            <span class="old-price">${{ number_format($product->asset_old_price, 2) }}</span>
                        @endif
                        <span class="new-price">${{ number_format($product->asset_price, 2) }}</span>
                    </div>

                    <div class="product-desc">
                        <p>{!! $product->asset_description  !!}</p>
                    </div>

                    <ul class="single-info-list">
                        <li class="d-none">SKU: <strong>{{ $product->id }}</strong></li>
                        <li>CATEGORY: <strong>{{ strtoupper($product->asset_category) }}</strong></li>
                    </ul>

                    <p>Price per product : ${{ number_format($product->asset_price, 2) }}</p>
                    <div class="product-action d-flex align-items-center">
                        <div class="product-single-qty mr-3">
                            <div class="input-group quantity">
                                <button class="qty-btn btn-decrease btn btn-light">-</button>
                                <input type="text" class="form-control qty-input text-center" value="1" readonly>
                                <button class="qty-btn btn-increase btn btn-light">+</button>
                            </div>
                        </div>

                        <a href="javascript:;" class="btn btn-dark add-cart" title="Add to Cart" data-product-id="{{ $product->id }}">
                            Add to Cart
                        </a>
                    </div>


                  <script>
                    $(document).ready(function(){

                        // Quantity Buttons
                        $('.btn-increase').click(function(){
                            let $input = $(this).siblings('.qty-input');
                            let val = parseInt($input.val());
                            $input.val(val + 1);
                        });

                        $('.btn-decrease').click(function(){
                            let $input = $(this).siblings('.qty-input');
                            let val = parseInt($input.val());
                            if(val > 1) $input.val(val - 1);
                        });

                        // Add to Cart
                        $('.add-cart').click(function(e){
                            e.preventDefault();

                            let productId = $(this).data('product-id');
                            let quantity = parseInt($(this).closest('.product-action').find('.qty-input').val());

                            $.ajax({
                                url: '/cart/add',
                                method: 'POST',
                                data: {
                                    product_id: productId,
                                    quantity: quantity,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(res){
                                    $('#cart-count').text(res.count);
                                    alert('Added to cart!');
                                },
                                error: function(err){
                                    console.log(err);
                                    alert('Error adding to cart'.err);
                                }
                            });
                        });

                        // Wishlist
                        $('.btn-icon-wish').click(function(e){
                            e.preventDefault();
                            let productId = $(this).data('product-id');

                            $.post("/wishlist/add", {product_id: productId, _token: "{{ csrf_token() }}"}, function(res){
                                $('#wishlist-count').text(res.count);
                            });
                        });

                    });
                    </script>

                </div>
            </div>
        </div>

        {{-- 🧩 Related Products --}}
        @if ($relatedProducts->count() > 0)
            <div class="products-section pt-0">
                <h2 class="section-title">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    @foreach ($relatedProducts as $related)
                        @php $relatedPhotos = json_decode($related->asset_photos, true) ?? []; @endphp
                        <div class="product-default">
                            <figure>
                                <a href="{{ url('product-details/' . Crypt::encrypt($related->id)) }}">
                                    @if(isset($relatedPhotos[0]))
                                        <img src="{{ asset($relatedPhotos[0]) }}" width="280" height="280" alt="{{ $related->asset_name }}">
                                    @endif
                                </a>
                                <div class="label-group">
                                   {{-- ✅ Dynamic Label --}}
                                    @if ($related->asset_type === 'new arrivals')
                                        <div class="label-group">
                                            <div class="product-label bg-info">NEW</div>
                                        </div>
                                    @elseif ($related->asset_type === 'hot deals')
                                        <div class="label-group">
                                            <div class="product-label bg-danger">HOT</div>
                                        </div>
                                    @elseif ($related->asset_type === 'featured product')
                                        <div class="label-group">
                                            <div class="product-label bg-success">FEATURED</div>
                                        </div>
                                    @endif
                                </div>
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="#" class="product-category">{{ ucfirst($related->asset_category) }}</a>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ url('product-details/' . Crypt::encrypt($related->id)) }}">
                                        {{ Str::limit($related->asset_name, 25) }}
                                    </a>
                                </h3>
                                 <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{ rand(70, 100) }}%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                                <div class="price-box text-left">
                                    <span class="product-price">${{ number_format($related->asset_price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</main>
@endsection
