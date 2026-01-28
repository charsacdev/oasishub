<div>
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Account</li>
                        </ol>
                    </div>
                </nav>

                <h1>Forgot Password</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto p-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Password Reset</h2>
                            </div>

                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form wire:submit.prevent="sendResetLink">
                                <label for="email">Email address <span class="required">*</span></label>
                                <input type="email" wire:model="email" class="form-input form-wide" required />

                                @error('email') 
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div class="form-footer mb-2">
									<button type="submit" class="btn btn-dark btn-md" style="width:100%;margin-right: 0rem;" wire:loading.attr="disabled">
                                        <span wire:loading.remove>Send Reset Link</span>
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
