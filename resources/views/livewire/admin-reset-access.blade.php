<div>

    <div class="bg-image"></div>
    <div class="overlay"></div>

    <div class="d-flex justify-content-center align-items-center p-3" style="min-height:100vh;">
        <div class="login-wrapper">
            <h2><i class="fa-solid fa-crown me-2"></i> Oasis Admin Forgot Password</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form wire:submit.prevent="resetAccess">
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fa-solid fa-envelope me-2"></i>Email</label>
                    <input type="email" class="form-control" id="email" wire:model="email" placeholder="Enter your email" required autofocus>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <!--wire button loading-->
                <button type="submit" 
                        class="btn btn-login" 
                        wire:loading.attr="disabled" 
                        wire:target="resetAccess">
                    <span wire:loading.remove wire:target="resetAccess">
                        Reset
                    </span>
                    <span wire:loading wire:target="resetAccess">
                        <i class="fa fa-spinner fa-spin me-1"></i> Processing...
                    </span>
                </button>

            </form>

            <div class="login-footer">
                <p><a href="/ultlogin">Remember password? login now</a></p>
            </div>
        </div>
    </div>

</div>
