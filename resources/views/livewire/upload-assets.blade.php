<div>

         <div class="container">
                <div class="card shadow-lg rounded-2" style="overflow:auto;border:0px solid green">
                <div class="card-header  text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fa-solid fa-plus"></i> Add Assets</h5>
                </div>
                <div class="card-body">

                    <!--Message-->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                   <form wire:submit.prevent="save">
                        <!-- Property Name -->
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control shadow-none" wire:model="property_name" placeholder="Enter product name">
                            @error('property_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Photos -->
                        <div class="mb-3">
                            <label class="form-label">Upload Photos</label>
                            <input type="file" class="form-control shadow-none" wire:model="new_photos" multiple accept="image/*">
                            <small class="text-muted">You can select multiple photos</small>
                            @error('new_photos.*') <span class="text-danger">{{ $message }}</span> @enderror

                            <div class="mt-2 d-flex flex-wrap gap-2">
                                @foreach($existing_photos as $photo)
                                    @if ($photo instanceof \Livewire\TemporaryUploadedFile)
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="img-thumbnail" style="width:120px;height:100px">
                                    @else
                                        <img src="{{ asset($photo) }}" alt="Preview" class="img-thumbnail" style="width:120px;height:100px">
                                    @endif
                                @endforeach

                            </div>
                        </div>

                         <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select shadow-none" wire:model="category">
                                <option value="">Choose section type</option>
                                @foreach($categoryProduct as $item)
                                  <option value="{{$item->category_name}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-3">
                            <label class="form-label">Sections</label>
                            <select class="form-select shadow-none" wire:model="type">
                                <option value="">Choose section type</option>
                                <option value="new arrivals">New Arrivals</option>
                                <option value="hot deals">Hot deals</option>
                                <option value="featured product">Featured Product</option>
                            </select>
                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label class="form-label">Price ($)</label>
                            <input type="number" class="form-control shadow-none" wire:model="price" placeholder="Enter price">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3" wire:ignore>
                            <label class="form-label">Description</label>
                            <textarea id="summernote" class="form-control" required>{!! $description !!}</textarea>
                              @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save"><i class="fa-solid fa-check"></i> Add Asset</span>
                                <span wire:loading wire:target="save"><i class="fa fa-spinner fa-spin"></i> Uploading...</span>
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
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']], // 👈 enable font size
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '28', '32', '36', '48', '64', '82', '150'],
            callbacks: {
                onChange: function(contents) {
                    @this.set('description', contents);
                }
            }
        });

     });
</script>


