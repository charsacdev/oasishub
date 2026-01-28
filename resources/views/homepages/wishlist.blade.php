@extends('homepages.header')
@section('content')

        <main class="main">
            <div class="page-header">
                <div class="container d-flex flex-column align-items-center">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <div class="container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Wishlist
                                </li>
                            </ol>
                        </div>
                    </nav>

                    <h1>Wishlist</h1>
                </div>
            </div>
           <center>
            <div class="container p-2 mt-5">
                <div class="wishlist-title">
                    <h2 class="p-2">My wishlist on Oasis Hub</h2>
                </div>
                <div class="wishlist-table-container">
                    <table class="table table-wishlist table-responsive mb-0">
                        <thead style="white-space:nowrap ">
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="status-col">Stock Status</th>
                                <th class="action-col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="product-row" style="white-space: nowrap">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="/products" class="product-image">
                                            <img src="assets-2/images/products/product-4.jpg" class="img-fluid img-thumbnail" style="max-width:100px;height:100px" alt="product">
                                        </a>

                                        <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                        <a href="/products">Men Watch</a>
                                    </h5>
                                </td>
                                <td class="price-box">$17.90</td>
                                <td>
                                    <span class="stock-status">In stock</span>
                                </td>
                                <td class="action">
                                    <a href="/product-details" class="btn btn-quickview mt-1 mt-md-0"
                                        title="Quick View">Quick
                                        View</a>
                                    <button class="btn btn-dark btn-add-cart product-type-simple btn-shop">
                                        ADD TO CART
                                    </button>
                                </td>
                            </tr>

                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="/products" class="product-image">
                                            <img src="assets-2/images/products/product-5.jpg" class="img-fluid img-thumbnail" style="max-width:100px;height:100px" alt="product">
                                        </a>

                                        <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                        <a href="/products">Men Cap</a>
                                    </h5>
                                </td>
                                <td class="price-box">$17.90</td>
                                <td>
                                    <span class="stock-status">In stock</span>
                                </td>
                                <td class="action">
                                    <a href="/product-details" class="btn btn-quickview mt-1 mt-md-0"
                                        title="Quick View">Quick
                                        View</a>
                                    <a href="/products" class="btn btn-dark btn-add-cart btn-shop">
                                        More Products
                                    </a>
                                </td>
                            </tr>

                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="/products" class="product-image">
                                            <img src="assets-2/images/products/product-6.jpg" class="img-fluid img-thumbnail" style="max-width:100px;height:100px" alt="product">
                                        </a>

                                        <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                        <a href="/products">Men Black Gentle Belt</a>
                                    </h5>
                                </td>
                                <td class="price-box">$17.90</td>
                                <td>
                                    <span class="stock-status">In stock</span>
                                </td>
                                <td class="action">
                                    <a href="/product-details" class="btn btn-quickview mt-1 mt-md-0"
                                        title="Quick View">Quick
                                        View</a>
                                    <a href="/products" class="btn btn-dark btn-add-cart btn-shop">
                                        More Products
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- End .cart-table-container -->
            </div>
           </center>
            <!-- End .container -->
        </main><!-- End .main -->

@endsection