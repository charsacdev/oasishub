@extends('homepages.header')
@section('content')

<main class="main about">
    <div class="page-header page-header-bg text-left"
        style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
        <div class="container">
            <h1><span>ABOUT US</span> OUR COMPANY</h1>
            <a href="#faq" class="btn btn-dark">Help & FAQs</a>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </div>
    </nav>

    <div class="about-section">
        <div class="container">
            <h2 class="subtitle">OUR STORY: Welcome to the Oasis</h2>
            <p>At <b>Oasis Hub</b>, we believe that every passion project, unique creation, and carefully curated item deserves a place to shine...</p>
            
            <h2 class="subtitle mt-5">OUR MISSION</h2>
            <p>Our mission is simple: To <b>empower independent sellers</b> by providing the most intuitive, beautiful, and feature-rich platform...</p>

            <h2 class="subtitle mt-5">OUR CORE VALUES</h2>
            <ul>
                <li><strong>Authenticity:</strong> We encourage sellers to be themselves...</li>
                <li><strong>Accessibility:</strong> Our tools and platform are easy to use...</li>
                <li><strong>Trust & Transparency:</strong> We maintain clear policies and secure transactions...</li>
            </ul>

            <p class="lead mt-5">
                “Oasis Hub is built on the belief that supporting independent creators fuels a richer, more diverse global economy.”
            </p>

            <p class="mt-4">
                Ready to start shopping or find your next favorite item? 
                <a href="/products">Shop Now!</a>
            </p>
        </div>
    </div>

    <div class="features-section bg-gray">
        <div class="container">
            <h2 class="subtitle">WHY CHOOSE US</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="feature-box bg-white p-3">
                        <i class="icon-shipped"></i>
                        <div class="feature-box-content p-2">
                            <h3>Seller Shipping Options</h3>
                            <p><b>Flexible Delivery:</b> Our sellers offer diverse shipping options...</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-box bg-white p-3">
                        <i class="icon-us-dollar"></i>
                        <div class="feature-box-content p-2">
                            <h3>Secure Transactions</h3>
                            <p><b>Shop With Confidence:</b> All purchases are backed by Oasis's secure payment system...</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-box bg-white p-3">
                        <i class="icon-online-support"></i>
                        <div class="feature-box-content p-2">
                            <h3>Community Support 24/7</h3>
                            <p><b>Dedicated Help:</b> Our support team is here around the clock...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ FAQ SECTION --}}
    <section id="faq" class="py-5 bg-white border-top">
        <div class="container">
            <h2 class="subtitle mb-4 text-center">HELP & FAQs</h2>
            <div class="accordion" id="faqAccordion">

                <div class="card">
                    <div class="card-header" id="faq1">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1">
                                How do I create an account?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse1" class="collapse show" data-parent="#faqAccordion">
                        <div class="card-body">
                            Creating an account is simple! Click “Sign Up” at the top of any page, fill in your details, and verify your email.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="faq2">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse2">
                                How do I track my order?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse2" class="collapse" data-parent="#faqAccordion">
                        <div class="card-body">
                            You can track your order from your dashboard under “My Orders.” Updates will also be sent via email.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="faq3">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse3">
                                What payment methods do you accept?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse3" class="collapse" data-parent="#faqAccordion">
                        <div class="card-body">
                            We accept major payment methods including Crypto, PayPal, and verified wallet transfers etc.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="faq4">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse4">
                                How do I contact customer support?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse4" class="collapse" data-parent="#faqAccordion">
                        <div class="card-body">
                            You can reach us anytime via the “Contact Us” form or by emailing <b>support@oasishub.com</b>.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

	{{-- ✅ ORDER TRACKING SECTION --}}
<section id="tracking" class="py-5 bg-light border-top">
    <div class="container">
        <h2 class="subtitle mb-4">Order Tracking</h2>
        <p>You can track your order status in your dashboard under <b>“Orders”</b>. 
           Simply log in, click your order ID, and view real-time shipping updates.
           Notifications are also sent to your email at each delivery stage.</p>
    </div>
</section>

{{-- ✅ SHIPPING & DELIVERY SECTION --}}
<section id="shipping" class="py-5 bg-white border-top">
    <div class="container">
        <h2 class="subtitle mb-4">Shipping & Delivery</h2>
        <p>Our sellers offer flexible delivery options such as <b>standard</b>, <b>express</b>, and <b>local pickup</b>. 
           Delivery times depend on your location and the seller’s shipping preferences. 
           All shipping details are shown during checkout.</p>
    </div>
</section>

{{-- ✅ ORDERS HISTORY SECTION --}}
<section id="orders" class="py-5 bg-light border-top">
    <div class="container">
        <h2 class="subtitle mb-4">Orders History</h2>
        <p>Your complete order history is available under <b>“Dashboard → Orders”</b>. 
           You can review past purchases, download invoices, and reorder items easily.</p>
    </div>
</section>

{{-- ✅ ADVANCED SEARCH SECTION --}}
<section id="search" class="py-5 bg-white border-top">
    <div class="container">
        <h2 class="subtitle mb-4">Advanced Search</h2>
        <p>Use our <b>Advanced Search</b> to find exactly what you need. 
           Filter products by category, price range, rating, and brand to quickly locate items that match your preferences.</p>
    </div>
</section>

{{-- ✅ CAREERS SECTION --}}
<section id="careers" class="py-5 bg-light border-top">
    <div class="container">
        <h2 class="subtitle mb-4">Careers</h2>
        <p>We’re always looking for passionate individuals to join our growing team. 
           to explore open positions or send your CV to <b>support@oasisvistahub.com</b>.</p>
    </div>
</section>

{{-- ✅ CORPORATE SALES SECTION --}}
<section id="corporate" class="py-5 bg-white border-top">
    <div class="container">
        <h2 class="subtitle mb-4">Corporate Sales</h2>
        <p>For bulk or corporate purchases, contact our <b>Corporate Sales Department</b> at <b>support@oasisvistahub.com</b>. 
           We provide discounts, custom packaging, and dedicated account support for business clients.</p>
    </div>
</section>

</main>
@endsection
