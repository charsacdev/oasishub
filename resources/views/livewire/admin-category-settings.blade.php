<div class="py-3">

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Add Category Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus-circle me-1"></i> Add Category
        </button>
    </div>

    <!-- Category List Table -->
    <div class="table-custom">
        <h5 class="table-h">Existing Categories</h5>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categoryProduct as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <img src="{{ asset($category->category_image) }}" alt="{{ $category->category_name }}" width="80" class="rounded">
                            </td>
                            <td>{{ $category->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No categories added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form wire:submit.prevent="saveCategory" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" wire:model="category_name" class="form-control shadow-none" placeholder="Enter category name">
                            @error('category_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="categoryImage" class="form-label">Category Image</label>
                            <input type="file" wire:model="category_image" class="form-control shadow-none" accept="image/*">
                            @error('category_image') <span class="text-danger">{{ $message }}</span> @enderror

                            @if ($category_image)
                                <div class="mt-2">
                                    <img src="{{ $category_image->temporaryUrl() }}" alt="Preview" class="rounded" width="120">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="saveCategory"><i class="fa-solid fa-check"></i> Add Category</span>
                                <span wire:loading wire:target="saveCategory"><i class="fa fa-spinner fa-spin"></i> Uploading...</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
