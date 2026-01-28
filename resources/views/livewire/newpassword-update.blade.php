<div>
    <div class="bg-image"></div>
    <div class="overlay"></div>

    <div class="d-flex justify-content-center align-items-center p-3" style="min-height:100vh;">
        <div class="login-wrapper">
            <h2><i class="fa-solid fa-crown me-2"></i> Oasis Admin New Password</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form wire:submit.prevent="updatePassword">
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="fa-solid fa-lock me-2"></i>New Password</label>
                    <input type="password" class="form-control" id="password" wire:model="password" placeholder="Enter password" required>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label"><i class="fa-solid fa-lock me-2"></i>Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation" placeholder="Confirm password" required>
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-login"
                        wire:loading.attr="disabled"
                        wire:target="updatePassword">
                    <span wire:loading.remove wire:target="updatePassword">Update</span>
                    <span wire:loading wire:target="updatePassword">
                        <i class="fa fa-spinner fa-spin me-1"></i> Updating...
                    </span>
                </button>
            </form>

            <div class="login-footer mt-3">
                <p><a href="/ultlogin">Remember password ? login now</a></p>
            </div>
        </div>
    </div>
</div>
