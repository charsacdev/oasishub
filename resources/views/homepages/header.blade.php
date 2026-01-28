<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Oasis Hub</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Oasis Hub">
    <meta name="author" content="">

     <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets-2/images/icons/favicon.png')}}">


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{asset('assets-2/js/webfont.js')}}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('assets-2/css/bootstrap.min.css')}}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('assets-2/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets-2/css/demo4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets-2/vendor/fontawesome-free/css/all.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets-2/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets-2/vendor/fontawesome-free/css/all.min.css')}}">
</head>

<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container">
                   
                    <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                        <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                            <a href="#">Links</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="/dashboard">Dashboard</a></li>
                                    <li><a href="/about">About Us</a></li>
                                    <li class="d-none"><a href="/wishlist">My Wishlist</a></li>
                                    <li><a href="/cart">Cart</a></li>
                                    <li><a href="/register">Register</a></li>
                                    <li><a href="/login">Login</a></li>
                                </ul>
                            </div>
                            <!-- End .header-menu -->
                        </div>
                        <!-- End .header-dropown -->

                        <span class="separator"></span>

                        <div class="social-icons">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                        </div>
                        <!-- End .social-icons -->
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-top -->

            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                <div class="container">
                    <div class="header-left col-lg-2 w-auto pl-0">
                        <button class="mobile-menu-toggler text-primary mr-2" type="button">
							<i class="fas fa-bars"></i>
						</button>
                        <a href="/" class="logo">
                            <img src="{{asset('assets-2/images/logo.png')}}" width="111" height="44" alt="Porto Logo">
                        </a>
                    </div>
                    <!-- End .header-left -->

                    <div class="header-right w-lg-max">
                        <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                              <form action="{{ route('search.products') }}" method="post">
                                @csrf
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                                        <select id="asset-name" name="q" id="q">
                                            <option value="">Select Asset</option>
                                        </select>
                                    


                                    {{-- Category Dropdown --}}
                                    <div class="select-custom">
                                        <select id="cat" name="cat" required>
                                            <option value="">All Categories</option>
                                            @foreach($allAssets as $category => $assets)
                                                <option value="{{ $category }}">{{ $category }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                  
                                    <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                                </div>
                            </form>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const allAssets = @json($allAssets); // load all grouped assets
                                    const categorySelect = document.getElementById('cat');
                                    const assetDropdown = document.getElementById('asset-dropdown');
                                    const assetSelect = document.getElementById('asset-name');
                                    const searchInput = document.getElementById('q');

                                    categorySelect.addEventListener('change', function() {
                                        const selectedCategory = this.value;
                                        assetSelect.innerHTML = '<option value="">Select Asset</option>';

                                        if (selectedCategory && allAssets[selectedCategory]) {
                                            allAssets[selectedCategory].forEach(asset => {
                                                assetSelect.innerHTML += `<option value="${asset.asset_name}">${asset.asset_name}</option>`;
                                            });
                                            assetDropdown.style.display = 'block';
                                        } else {
                                            assetDropdown.style.display = 'none';
                                        }
                                    });

                                    // Auto-fill search input when user picks an asset
                                    assetSelect.addEventListener('change', function() {
                                        const selectedAsset = this.value;
                                        if (selectedAsset) {
                                            searchInput.value = selectedAsset;
                                        }
                                    });
                                });
                                </script>
                        </div>
                        

                        <a href="/login" class="header-icon" title="login"><i class="icon-user-2"></i></a>

                        <a href="/wishlist" class="header-icon d-none" title="wishlist"><i class="icon-wishlist-2"></i></a>

                        <div class="dropdown cart-dropdown">
                            <a href="/cart" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button">
                                <i class="minicart-icon"></i>
                                <span class="cart-count badge-circle" id="cart-count">{{$cartCount}}</span>
                            </a>

                           
                        </div>

                    </div>
                </div>
            </div>
            <!-- End .header-middle -->

            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                <div class="container">
                    <nav class="main-nav w-100">
                        <ul class="menu">
                            <li class="active">
                                <a href="/">Home</a>
                            </li>
                           
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-bottom -->
        </header>
        <!-- End .header -->


        <!--YEILD-->
        @yield('content')


           <footer class="footer" id="footer" style="background-color:#000">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Contact Info</h4>
                                <ul class="contact-info">
                                    <li>
                                        <span class="contact-info-label">Address:</span>Shaalan Street, Damascus, Syria.
                                    </li>
                                    <li class="d-none">
                                        <span class="contact-info-label">Phone:</span><a href="tel:">(123)
											456-7890</a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Email:</span><br>
                                        <a href="mailto:support@oasisvistahub.com"><span class="__cf_email__" data-cfemail="305d51595c705548515d405c551e535f5d"></span>support@oasisvistahub.com</a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Working Days/Hours:</span> Mon - Sun / 9:00 AM - 8:00 PM
                                    </li>
                                </ul>
                                <div class="social-icons">
                                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                    <a href="#" class="social-icon social-instagram icon-instagram" target="_blank" title="Instagram"></a>
                                </div>
                                <!-- End .social-icons -->
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-lg-3 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4>

                                <ul class="links">
                                    <li><a href="/about#faq">Help & FAQs</a></li>
                                    <li><a href="/about#tracking">Order Tracking</a></li>
                                    <li><a href="/about#shipping">Shipping & Delivery</a></li>
                                    <li><a href="/about#orders">Orders History</a></li>
                                    <li><a href="/about#search">Advanced Search</a></li>
                                    <li><a href="/about#careers">Careers</a></li>
                                    <li><a href="/about">About Us</a></li>
                                    <li><a href="/about#corporate">Corporate Sales</a></li>
                                </ul>
                            </div>
                            <!-- End .widget -->
                        </div>
                       
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-middle -->

            <div class="container">
                <div class="footer-bottom">
                    <div class="container d-sm-flex align-items-center">
                        <div class="footer-left">
                            <span class="footer-copyright">© Oasis Hub. 2013 - {{date("Y")}}. All Rights Reserved</span>
                        </div>

                    </div>
                </div>
                <!-- End .footer-bottom -->
            </div>
            <!-- End .container -->
        </footer>
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
            <nav class="mobile-nav">
              
                <ul class="mobile-menu">
                    <li><a href="#">My Account</a></li>
                    <li><a href="#footer">Contact Us</a></li>
                    <li><a href="/cart">Cart</a></li>
                    <li><a href="/login">Log In</a></li>
                    <li><a href="/register">Register</a></li>
                </ul>
            </nav>
            <!-- End .mobile-nav -->
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="/">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="/dashboard" class="">
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="/login" class="">
                <i class="icon-user-2"></i>Login
            </a>
        </div>
        <div class="sticky-info">
            <a href="/cart" class="">
                <i class="icon-shopping-cart position-relative">
					<span class="cart-count badge-circle">{{$cartCount}}</span>
				</i>Cart
            </a>
        </div>
        <div class="sticky-info">
            <a href="/preorder" class="">
                <i class="icon-shopping-cart position-relative">
				</i>Pre Order
            </a>
        </div>
    </div>

   

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script><script src="{{asset('assets-2/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets-2/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets-2/js/optional/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets-2/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets-2/js/jquery.appear.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('assets-2/js/main.min.js')}}"></script>
    <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99316713b81aede6',t:'MTc2MTIyNDI3MQ=='};var a=document.createElement('script');a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>

    <!-- Smartsupp Live Chat script -->
        <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '92f8e479afa64cc849397f119d69db37f4194ad1';
        window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
        </script>
        <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>

</html>