<div>
        <div class="col-lg-12">
            <div class="card shadow-lg rounded-4">
                <div class="card-header text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-envelope"></i> Send Message</h5>
                </div>
                <div class="card-body">
                    
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form wire:submit.prevent="sendMessage">
                        <div class="mb-3">
                            <label class="form-label">Recipient Email</label>
                            <input type="email" class="form-control" wire:model="email" placeholder="Enter user email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message Title</label>
                            <input type="text" class="form-control" wire:model="title" placeholder="Enter message title">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3" wire:ignore>
                            <label class="form-label">Message Body</label>
                            <textarea id="summernote" class="form-control" required>{!! $body !!}</textarea>
                            @error('body') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4" wire:click.prevent="sendMessage" wire:loading.attr="disabled" wire:target="sendMessage">
                                <span wire:loading.remove wire:target="sendMessage">
                                    <i class="fa fa-paper-plane"></i> Send Message
                                </span>
                                <span wire:loading wire:target="sendMessage">
                                    <i class="fa fa-spinner fa-spin"></i> Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function() {
       $('#summernote').summernote({
            height: 400,
            callbacks: {
                onChange: function(contents) {
                    @this.set('body', contents);
                }
            }
        });

     });
</script>

