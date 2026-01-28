<div>
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
                        </ol>
                    </div>
                </nav>
                <h1>Create Account</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto p-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6" style="border:0px solid green">
                            <div class="heading mb-1">
                                <h2 class="title">Register</h2>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form wire:submit.prevent="register">
                                <label>Email address <span class="required">*</span></label>
                                <input type="email" class="form-input form-wide" wire:model="email" required />
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                                <label class="mt-3">Password <span class="required">*</span></label>
                                <input type="password" class="form-input form-wide" wire:model="password" required />
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror

								<a href="/login"
											class="forget-password text-dark form-footer-right">Login
								</a>
                                <div class="form-footer mt-3">
                                    <button type="submit" class="btn btn-dark btn-md" style="width:100%;margin-right: 0rem;" wire:loading.attr="disabled">
                                        <span wire:loading.remove>Register</span>
                                        <span wire:loading>
                                            <i class="fa fa-spinner fa-spin"></i> Processing...
                                        </span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
