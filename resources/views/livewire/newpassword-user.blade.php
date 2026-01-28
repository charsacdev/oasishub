<div>
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Password</li>
                        </ol>
                    </div>
                </nav>

                <h1>New Password</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto p-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Reset Your Password</h2>
                            </div>

                            {{-- Success or Error Messages --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form wire:submit.prevent="updatePassword">
                                <div class="mb-3">
                                    <label for="password">Password <span class="required">*</span></label>
                                    <input type="password" wire:model="password" id="password" class="form-input form-wide" required>
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password">Confirm Password <span class="required">*</span></label>
                                    <input type="password" wire:model="confirm_password" id="confirm_password" class="form-input form-wide" required>
                                    @error('confirm_password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="form-footer mb-2">
                                    <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                        Reset Password
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
