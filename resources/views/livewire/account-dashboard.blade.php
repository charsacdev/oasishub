<div class="container my-5">
	<style>
		.card-body a {
		text-decoration: none;
		color: inherit; /* optional: keeps same text color */
		}
	</style>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Account</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <h5 class="bg-dark text-white p-3 mb-0 text-uppercase">Menu</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#" wire:click.prevent="switchTab('dashboard')" class="nav-link {{ $tab === 'dashboard' ? 'fw-bold text-dark' : '' }}">Dashboard</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" wire:click.prevent="switchTab('orders')" class="nav-link {{ $tab === 'orders' ? 'fw-bold text-dark' : '' }}">Orders</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" wire:click.prevent="switchTab('profile')" class="nav-link {{ $tab === 'profile' ? 'fw-bold text-dark' : '' }}">Profile Information</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('user.logout') }}" class="nav-link text-danger">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main -->
        <div class="col-lg-9">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

			@if (session('error'))
				<div class="alert alert-danger">{{ session('error') }}</div>
			@endif

            <!-- Dashboard -->
            @if($tab === 'dashboard')
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-5">
                        <h4 class="mb-4 fw-bold">Welcome, {{ auth()->user()->first_name ?? 'User' }}!</h4>

                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-4">
                                    <a href="#" wire:click.prevent="switchTab('orders')" class="text-decoration-none text-dark">
                                        <i class="sicon-social-dropbox fs-1 mb-2 d-block"></i>
                                        <h5>Orders</h5>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-4">
                                    <a href="#" wire:click.prevent="switchTab('profile')" class="text-decoration-none text-dark">
                                        <i class="icon-user-2 fs-1 mb-2 d-block"></i>
                                        <h5>Profile</h5>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-4">
                                    <a href="{{ route('user.logout') }}" class="text-decoration-none text-danger">
                                        <i class="sicon-logout fs-1 mb-2 d-block"></i>
                                        <h5>Logout</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Orders -->
            @if($tab === 'orders')
               <div class="card shadow-sm border-0">
					<div class="card-body">
						<h4 class="fw-bold mb-4">
							<i class="sicon-social-dropbox me-2"></i>My Orders
						</h4>

						<div class="table-responsive">
							<table class="table table-bordered align-middle text-center">
								<thead class="table-dark">
									<tr style="white-space: nowrap">
										<th>S/N</th>
										<th>Order ID</th>
										<th>Date</th>
										<th>Status</th>
										<th>Total</th>
										<th>Details</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($orders as $order)
										<tr style="white-space: nowrap">
											<td>#{{ $loop->iteration }}</td>
											<td>#{{ $order->cart_id }}</td>
											<td>{{ $order->created_at->format('M d, Y') }}</td>
											<td>
												<span class="badge text-light 
													{{ $order->order_status == 'pending' ? 'bg-warning' : 
													($order->order_status == 'completed' ? 'bg-success' : 'bg-secondary') }}">
													{{ ucfirst($order->order_status) }}
												</span>
											</td>
											<td>${{ number_format($order->total ?? 0, 2) }}</td>
											<td>
												<!-- Optional: display product names -->
												<ul class="list-unstyled mb-0 text-left">
													@foreach ($order->cart as $cartItem)
														<li>{{ $cartItem->product->asset_name ?? 'Unknown Product' }} 
															× {{ $cartItem->quantity ?? 1 }}
														</li>
													@endforeach
												</ul>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="6" class="text-muted py-5">
												No orders have been made yet.
											</td>
										</tr>
									@endforelse
								</tbody>

							</table>
						</div>

						@if($orders->isEmpty())
							<div class="text-center mt-4">
								<a href="/" class="btn btn-dark">Start Shopping</a>
							</div>
						@endif
					</div>
				</div>

            @endif

            <!-- Profile -->
            @if($tab === 'profile')
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4 text-uppercase">Profile Information</h4>

                        <form wire:submit.prevent="updateProfile">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" wire:model.defer="first_name" class="form-control" required>
                                    @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" wire:model.defer="last_name" class="form-control" required>
                                    @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Country</label>
                                    <select wire:model.defer="country" class="form-control" required>
										<option value="">Select Country</option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="Andorra">Andorra</option>
										<option value="Angola">Angola</option>
										<option value="Antigua and Barbuda">Antigua and Barbuda</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>
										<option value="Barbados">Barbados</option>
										<option value="Belarus">Belarus</option>
										<option value="Belgium">Belgium</option>
										<option value="Belize">Belize</option>
										<option value="Benin">Benin</option>
										<option value="Bhutan">Bhutan</option>
										<option value="Bolivia">Bolivia</option>
										<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
										<option value="Botswana">Botswana</option>
										<option value="Brazil">Brazil</option>
										<option value="Brunei">Brunei</option>
										<option value="Bulgaria">Bulgaria</option>
										<option value="Burkina Faso">Burkina Faso</option>
										<option value="Burundi">Burundi</option>
										<option value="Cabo Verde">Cabo Verde</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Cameroon">Cameroon</option>
										<option value="Canada">Canada</option>
										<option value="Central African Republic">Central African Republic</option>
										<option value="Chad">Chad</option>
										<option value="Chile">Chile</option>
										<option value="China">China</option>
										<option value="Colombia">Colombia</option>
										<option value="Comoros">Comoros</option>
										<option value="Congo (Brazzaville)">Congo (Brazzaville)</option>
										<option value="Congo (Kinshasa)">Congo (Kinshasa)</option>
										<option value="Costa Rica">Costa Rica</option>
										<option value="Croatia">Croatia</option>
										<option value="Cuba">Cuba</option>
										<option value="Cyprus">Cyprus</option>
										<option value="Czech Republic">Czech Republic</option>
										<option value="Denmark">Denmark</option>
										<option value="Djibouti">Djibouti</option>
										<option value="Dominica">Dominica</option>
										<option value="Dominican Republic">Dominican Republic</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Egypt">Egypt</option>
										<option value="El Salvador">El Salvador</option>
										<option value="Equatorial Guinea">Equatorial Guinea</option>
										<option value="Eritrea">Eritrea</option>
										<option value="Estonia">Estonia</option>
										<option value="Eswatini">Eswatini</option>
										<option value="Ethiopia">Ethiopia</option>
										<option value="Fiji">Fiji</option>
										<option value="Finland">Finland</option>
										<option value="France">France</option>
										<option value="Gabon">Gabon</option>
										<option value="Gambia">Gambia</option>
										<option value="Georgia">Georgia</option>
										<option value="Germany">Germany</option>
										<option value="Ghana">Ghana</option>
										<option value="Greece">Greece</option>
										<option value="Grenada">Grenada</option>
										<option value="Guatemala">Guatemala</option>
										<option value="Guinea">Guinea</option>
										<option value="Guinea-Bissau">Guinea-Bissau</option>
										<option value="Guyana">Guyana</option>
										<option value="Haiti">Haiti</option>
										<option value="Honduras">Honduras</option>
										<option value="Hungary">Hungary</option>
										<option value="Iceland">Iceland</option>
										<option value="India">India</option>
										<option value="Indonesia">Indonesia</option>
										<option value="Iran">Iran</option>
										<option value="Iraq">Iraq</option>
										<option value="Ireland">Ireland</option>
										<option value="Israel">Israel</option>
										<option value="Italy">Italy</option>
										<option value="Jamaica">Jamaica</option>
										<option value="Japan">Japan</option>
										<option value="Jordan">Jordan</option>
										<option value="Kazakhstan">Kazakhstan</option>
										<option value="Kenya">Kenya</option>
										<option value="Kiribati">Kiribati</option>
										<option value="Kuwait">Kuwait</option>
										<option value="Kyrgyzstan">Kyrgyzstan</option>
										<option value="Laos">Laos</option>
										<option value="Latvia">Latvia</option>
										<option value="Lebanon">Lebanon</option>
										<option value="Lesotho">Lesotho</option>
										<option value="Liberia">Liberia</option>
										<option value="Libya">Libya</option>
										<option value="Liechtenstein">Liechtenstein</option>
										<option value="Lithuania">Lithuania</option>
										<option value="Luxembourg">Luxembourg</option>
										<option value="Madagascar">Madagascar</option>
										<option value="Malawi">Malawi</option>
										<option value="Malaysia">Malaysia</option>
										<option value="Maldives">Maldives</option>
										<option value="Mali">Mali</option>
										<option value="Malta">Malta</option>
										<option value="Mauritania">Mauritania</option>
										<option value="Mauritius">Mauritius</option>
										<option value="Mexico">Mexico</option>
										<option value="Moldova">Moldova</option>
										<option value="Monaco">Monaco</option>
										<option value="Mongolia">Mongolia</option>
										<option value="Montenegro">Montenegro</option>
										<option value="Morocco">Morocco</option>
										<option value="Mozambique">Mozambique</option>
										<option value="Myanmar (Burma)">Myanmar (Burma)</option>
										<option value="Namibia">Namibia</option>
										<option value="Nauru">Nauru</option>
										<option value="Nepal">Nepal</option>
										<option value="Netherlands">Netherlands</option>
										<option value="New Zealand">New Zealand</option>
										<option value="Nicaragua">Nicaragua</option>
										<option value="Niger">Niger</option>
										<option value="Nigeria">Nigeria</option>
										<option value="North Korea">North Korea</option>
										<option value="North Macedonia">North Macedonia</option>
										<option value="Norway">Norway</option>
										<option value="Oman">Oman</option>
										<option value="Pakistan">Pakistan</option>
										<option value="Palau">Palau</option>
										<option value="Panama">Panama</option>
										<option value="Papua New Guinea">Papua New Guinea</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Philippines">Philippines</option>
										<option value="Poland">Poland</option>
										<option value="Portugal">Portugal</option>
										<option value="Qatar">Qatar</option>
										<option value="Romania">Romania</option>
										<option value="Russia">Russia</option>
										<option value="Rwanda">Rwanda</option>
										<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
										<option value="Saint Lucia">Saint Lucia</option>
										<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
										<option value="Samoa">Samoa</option>
										<option value="San Marino">San Marino</option>
										<option value="Sao Tome and Principe">Sao Tome and Principe</option>
										<option value="Saudi Arabia">Saudi Arabia</option>
										<option value="Senegal">Senegal</option>
										<option value="Serbia">Serbia</option>
										<option value="Seychelles">Seychelles</option>
										<option value="Sierra Leone">Sierra Leone</option>
										<option value="Singapore">Singapore</option>
										<option value="Slovakia">Slovakia</option>
										<option value="Slovenia">Slovenia</option>
										<option value="Solomon Islands">Solomon Islands</option>
										<option value="Somalia">Somalia</option>
										<option value="South Africa">South Africa</option>
										<option value="South Korea">South Korea</option>
										<option value="South Sudan">South Sudan</option>
										<option value="Spain">Spain</option>
										<option value="Sri Lanka">Sri Lanka</option>
										<option value="Sudan">Sudan</option>
										<option value="Suriname">Suriname</option>
										<option value="Sweden">Sweden</option>
										<option value="Switzerland">Switzerland</option>
										<option value="Syria">Syria</option>
										<option value="Taiwan">Taiwan</option>
										<option value="Tajikistan">Tajikistan</option>
										<option value="Tanzania">Tanzania</option>
										<option value="Thailand">Thailand</option>
										<option value="Togo">Togo</option>
										<option value="Tonga">Tonga</option>
										<option value="Trinidad and Tobago">Trinidad and Tobago</option>
										<option value="Tunisia">Tunisia</option>
										<option value="Turkey">Turkey</option>
										<option value="Turkmenistan">Turkmenistan</option>
										<option value="Tuvalu">Tuvalu</option>
										<option value="Uganda">Uganda</option>
										<option value="Ukraine">Ukraine</option>
										<option value="United Arab Emirates">United Arab Emirates</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="United States">United States</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Uzbekistan">Uzbekistan</option>
										<option value="Vanuatu">Vanuatu</option>
										<option value="Vatican City">Vatican City</option>
										<option value="Venezuela">Venezuela</option>
										<option value="Vietnam">Vietnam</option>
										<option value="Yemen">Yemen</option>
										<option value="Zambia">Zambia</option>
										<option value="Zimbabwe">Zimbabwe</option>
									</select>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" wire:model.defer="city" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address</label>
                                    <input type="text" wire:model.defer="address" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">State/Province</label>
                                    <input type="text" wire:model.defer="state" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postcode</label>
                                    <input type="text" wire:model.defer="postcode" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" wire:model.defer="phone" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" wire:model.defer="email" class="form-control" readonly required>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-dark px-4">Save Information</button>
                            </div>
                        </form>

                        <hr class="my-5">

                        <h4 class="fw-bold mb-4 text-uppercase">Change Password</h4>
                        <form wire:submit.prevent="changePassword">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" wire:model.defer="current_password" class="form-control">
                                    @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" wire:model.defer="new_password" class="form-control">
                                    @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" wire:model.defer="confirm_password" class="form-control">
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-dark px-4">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
