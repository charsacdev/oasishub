<div>
        <div class="card shadow-lg rounded-4">
            <div class="card-header text-white">
                <h5 class="mb-0"><i class="fa-solid fa-user-cog"></i> Admin Settings</h5>
            </div>
            <div class="card-body">
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Profile Update Form -->
                <form wire:submit.prevent="updateProfile" class="mb-4">
                    <h6 class="mb-3"><i class="fa-solid fa-user"></i> Profile Info</h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" wire:model="fname">
                            @error('fname') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" wire:model="lname">
                            @error('lname') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save"></i> Save Profile
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                <!-- Password Update Form -->
                <form wire:submit.prevent="updatePassword">
                    <h6 class="mb-3"><i class="fa-solid fa-lock"></i> Change Password</h6>
                    
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" wire:model="currentPassword">
                        @error('currentPassword') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" wire:model="newPassword">
                            @error('newPassword') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" wire:model="confirmPassword">
                            @error('confirmPassword') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fa fa-key"></i> Update Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
</div>
