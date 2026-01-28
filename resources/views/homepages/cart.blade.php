@extends('homepages.header')
@section('content')

<main class="main">
    <div class="container">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Cart
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Cart</h1>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8">
                <!-- Success Message -->
                <div id="checkout-message">
                   
                </div>
            
               <div class="cart-table-container">
                 @if(!$cartItems->isEmpty())
                    <table class="table table-cart table-responsive">
                        <thead>
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Quantity</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="/products/{{ $item->product->id }}" class="product-image">
                                            <img src="{{ asset(json_decode($item->product->asset_photos)[0]) }}"
                                                style="max-width:100px;max-height:100px" alt="{{ $item->product->asset_name }}">
                                        </a>
                                    </figure>
                                </td>
                                <td class="product-col">
                                    <h5 class="product-title">
                                        <a href="/products/{{ $item->product->id }}">{{ $item->product->asset_name }}</a>
                                    </h5>
                                </td>
                                <td>${{ number_format($item->product->asset_price, 2) }}</td>
                                <td>
                                    <div class="product-single-qty d-flex">
                                        
                                        <input type="text" class="horizontal-quantity form-control mx-1" 
                                            value="{{ $item->quantity }}">
                                         <input type="hidden" class="asset-id" value="{{ $item->product->id }}">
                                        &nbsp;
                                        <button class="btn btn-sm btn-danger ml-2 remove-cart p-2" data-product-id="{{ $item->product_id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                 </td>
                                
                                <td class="text-right subtotal-price ">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="ml-5">${{ number_format($item->quantity * $item->product->asset_price, 2) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                <td class="text-right" id="cart-total">${{ number_format($cartTotal, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                  @else
                     <p>Cart is empty !</p>
                  @endif
                </div>
             
                 <script>
                    $(document).ready(function(){

                        // Event delegation for dynamically added buttons
                        $(document).on('click', '.bootstrap-touchspin-up, .bootstrap-touchspin-down', function(){

                            let $row = $(this).closest('tr');  // Get the row
                            let $input = $row.find('input.horizontal-quantity'); // quantity input
                            let $assetInput = $row.find('input.asset-id'); // hidden input for asset id

                            let assetId = $assetInput.val(); 
                            let quantity = parseInt($input.val()) || 1;

                            $input.val(quantity);

                            // Send AJAX request to update cart
                            $.ajax({
                                url: '/cart/update',
                                method: 'POST',
                                data: {
                                    product_id: assetId,
                                    quantity: quantity,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(res){
                                    //alert(res);
                                    // Update subtotal for this row
                                    $input.closest('tr').find('.subtotal-price').text('$' + parseFloat(res.subtotal).toFixed(2));

                                    // Update total
                                    $('#cart-total').text('$' + parseFloat(res.total).toFixed(2));

                                    // Update cart count in header
                                    $('#cart-count').text(res.count);
                                },
                                error: function(xhr){
                                    alert('Error updating cart. Please try again.');
                                    console.log(xhr.responseText);
                                }
                            });
                        });

                        // Remove item from cart
                        $(document).on('click', '.remove-cart', function() {
                            if (!confirm('Are you sure you want to remove this item?')) return;

                            let $row = $(this).closest('tr');
                            let assetId = $row.find('input.asset-id').val(); // get hidden input value for asset_id

                            $.ajax({
                                url: '/cart/remove',
                                method: 'POST',
                                data: {
                                    asset_id: assetId, // send asset_id to backend
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    // Remove the row from the table
                                    $row.remove();

                                    // Update subtotal / total
                                    $('#cart-total').text('$' + parseFloat(res.total).toFixed(2));

                                    // Update cart count
                                    $('#cart-count').text(res.count);

                                    // Optionally, show a toast or alert
                                    // alert('Item removed successfully');
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    alert('Something went wrong while removing the item.');
                                }
                            });
                        });


                    });
                    </script>
            </div>
       

        <div class="col-lg-4">
    @if(!$cartItems->isEmpty())
        <div class="cart-summary">
            <h3>CART TOTALS</h3>

            <table class="table table-totals">
                <tbody>
                    <tr>
                        <td colspan="2" class="text-left">
                            <h4>Shipping Details</h4>

                            <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                                @csrf

                                @auth
                                    {{-- =========== IF USER IS LOGGED IN =========== --}}
                                    <div class="p-3 mb-3 border rounded bg-light">
                                        <p><strong>Name:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                        <p><strong>Phone:</strong> {{ auth()->user()->phone }}</p>
                                        <p><strong>Address:</strong> {{ auth()->user()->house_address }}, {{ auth()->user()->city }}, {{ auth()->user()->state }} {{ auth()->user()->zip_code }}</p>
                                        <p><strong>Country:</strong> {{ auth()->user()->country }}</p>
                                    </div>

                                    {{-- Hidden fields to pass data --}}
                                    <input type="hidden" name="first_name" value="{{ auth()->user()->first_name }}">
                                    <input type="hidden" name="last_name" value="{{ auth()->user()->last_name }}">
                                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                    <input type="hidden" name="phone" value="{{ auth()->user()->phone }}">
                                    <input type="hidden" name="country" value="{{ auth()->user()->country }}">
                                    <input type="hidden" name="address" value="{{ auth()->user()->house_address }}">
                                    <input type="hidden" name="city" value="{{ auth()->user()->city }}">
                                    <input type="hidden" name="state" value="{{ auth()->user()->state }}">
                                    <input type="hidden" name="zip" value="{{ auth()->user()->zip_code }}">

                                    <button type="submit" id="checkout-btn" class="btn btn-block btn-dark">
                                        Proceed to Checkout <i class="fa fa-arrow-right"></i>
                                    </button>
                                @else
                                    {{-- =========== IF USER IS A GUEST =========== --}}
                                    <div class="form-group form-group-sm">
                                        <input type="text" name="first_name" class="form-control form-control-sm" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <input type="text" name="last_name" class="form-control form-control-sm" placeholder="Last Name" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <input type="email" name="email" class="form-control form-control-sm" placeholder="Email Address" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <input type="tel" name="phone" class="form-control form-control-sm" placeholder="Phone Number" required>
                                    </div>

                                    <h4 class="mt-3">Shipping Address</h4>

                                     <div class="form-group form-group-sm">
                                            <label>Country *</label>
                                            <div class="select-custom">
                                                <select name="country" class="form-control form-control-sm" required>
                                                    <option value="">Select a country...</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Åland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AQ">Antarctica</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia, Plurinational State of</option>
                                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BV">Bouvet Island</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="BN">Brunei Darussalam</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CG">Congo</option>
                                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d'Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">Curaçao</option>
                                                    <option value="CY">Cyprus</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                    <option value="FO">Faroe Islands</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="GF">French Guiana</option>
                                                    <option value="PF">French Polynesia</option>
                                                    <option value="TF">French Southern Territories</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GP">Guadeloupe</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="GY">Guyana</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="HM">Heard Island and McDonald Islands</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran, Islamic Republic of</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                                    <option value="KR">Korea, Republic of</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao</option>
                                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="YT">Mayotte</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia, Federated States of</option>
                                                    <option value="MD">Moldova, Republic of</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="NC">New Caledonia</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territory, Occupied</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PN">Pitcairn</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RE">Réunion</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russian Federation</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="PM">Saint Pierre and Miquelon</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">Sao Tome and Principe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syrian Arab Republic</option>
                                                    <option value="TW">Taiwan, Province of China</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania, United Republic of</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TL">Timor-Leste</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="US">United States</option>
                                                    <option value="UM">United States Minor Outlying Islands</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN">Viet Nam</option>
                                                    <option value="VG">Virgin Islands, British</option>
                                                    <option value="VI">Virgin Islands, U.S.</option>
                                                    <option value="WF">Wallis and Futuna</option>
                                                    <option value="EH">Western Sahara</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>

                                    <div class="form-group form-group-sm">
                                        <input type="text" name="address" class="form-control form-control-sm" placeholder="House Address / Street Name *" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <input type="text" name="city" class="form-control form-control-sm" placeholder="Town / City *" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <input type="text" name="state" class="form-control form-control-sm" placeholder="State / Province / Region *" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <input type="text" name="zip" class="form-control form-control-sm" placeholder="ZIP / Postcode *" required>
                                    </div>

                                    <button type="submit" id="checkout-btn" class="btn btn-block btn-dark">
                                        Proceed to Checkout <i class="fa fa-arrow-right"></i>
                                    </button>
                                @endauth
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <p>No Item selected. Please add an item to your cart!</p>
    @endif

    <div id="checkout-message" class="mt-3"></div>

    <script>
        $('#checkout-form').submit(function(e){
            e.preventDefault();

            let $btn = $('#checkout-btn');
            let originalText = $btn.html();

            // Show loading
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(res){
                    $('#checkout-message').html(
                        '<div class="alert alert-success">' + res.message + '</div>'
                    );

                    setTimeout(function(){
                        window.location.href = res.redirect;
                    }, 3000);
                },
                error: function(xhr){
                    let errors = xhr.responseJSON.errors;
                    let html = '<div class="alert alert-danger"><ul>';

                    if(errors){
                        $.each(errors, function(k,v){
                            html += '<li>' + v[0] + '</li>';
                        });
                    } else if(xhr.responseJSON.message){
                        html += '<li>' + xhr.responseJSON.message + '</li>';
                    }

                    html += '</ul></div>';
                    $('#checkout-message').html(html);
                },
                complete: function(){
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });
    </script>
</div>

       
    </div>
    <!-- End .row -->
    </div>

    <div class="mb-6"></div><!-- margin -->
</main>
<!-- End .main -->
@endsection