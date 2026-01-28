<div>

     <div class="bg-image"></div>
    <div class="overlay"></div>

    <div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <div class="login-wrapper">
            <h2><i class="fa-solid fa-crown me-2"></i> Admin Login</h2>

            <form wire:submit.prevent="login">
                @csrf
                <div class="mb-4">
                    <label><i class="fa-solid fa-envelope me-2"></i>&nbsp;Email</label>
                    <input type="email" wire:model="email" placeholder="Enter your email" class="form-control">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label><i class="fa-solid fa-lock me-2"></i>&nbsp;Password</label>
                    <input type="password" wire:model="password" placeholder="Enter password" class="form-control">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-login w-100"
                    wire:loading.attr="disabled"
                    wire:target="login">
                    <span wire:loading.remove wire:target="login">Login</span>
                    <span wire:loading wire:target="login"><i class="fa fa-spinner fa-spin"></i> Logging in...</span>
                </button>
            </form>

             <div class="login-footer">
                <p><a href="/forgotpassowrd">Forgot Password?</a></p>
            </div>
        </div>
    </div>

</div>
