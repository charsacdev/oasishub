<div>
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <h1>My Account</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading mb-1">
                        <h2 class="title">Login</h2>
                    </div>

					   @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
						@endif

						@if (session('error'))
							<div class="alert alert-danger">{{ session('error') }}</div>
						@endif

                    <form wire:submit.prevent="login">
                        <label for="login-email">
                            Email Address <span class="required">*</span>
                        </label>
                        <input type="email" wire:model="email" class="form-input form-wide" id="login-email" required />
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
						<br><br>

                        <label for="login-password">
                            Password <span class="required">*</span>
                        </label>
                        <input type="password" wire:model="password" class="form-input form-wide" id="login-password" required />
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                        <div class="form-footer d-flex justify-content-between align-items-center">
                            <div class="d-none">
                                <input type="checkbox" wire:model="remember" id="remember-me" />
                                <label for="remember-me" class="mb-0">Remember me</label>
                            </div>

                            <a href="/forgot" class="forget-password text-dark">Forgot Password?</a>
                        </div>

                         <button type="submit" class="btn btn-dark btn-md" style="width:100%;margin-right: 0rem;" wire:loading.attr="disabled">
							<span wire:loading.remove>Login</span>
							<span wire:loading>
								<i class="fa fa-spinner fa-spin"></i> Processing...
							</span>
						</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
