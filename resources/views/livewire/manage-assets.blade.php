<div>
    
        <div class="card shadow-lg rounded-4 m-0" style="height:100vh;">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa-solid fa-building"></i> Uploaded Assets</h5>
            </div>

            <!-- Messages -->
            @if (session('success'))
                <div class="alert alert-success m-2">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger m-2">{{ session('error') }}</div>
            @endif

            <div class="card-body table-responsive" wire:ignore>
                <table id="propertiesTable" class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr style="white-space: nowrap">
                            <th>ID</th>
                            <th>Property Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assets as $asset)
                            <tr style="white-space: nowrap">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $asset->asset_name }}</td>
                                <td>{{ $asset->asset_type }}</td>
                                <td>${{ number_format($asset->asset_price, 2) }}</td>
                                <td>{{ $asset->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ url('/admin/properties?asset=' . encrypt($asset->id)) }}" 
                                        class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                       </a>
                                    <button class="btn btn-sm btn-danger" 
                                            wire:click="confirmDelete({{ $asset->id }})">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No assets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
  

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fa fa-triangle-exclamation"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this property? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteAsset">
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('showDeleteModal', () => {
            let modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        });

        window.addEventListener('hideDeleteModal', () => {
            let modalEl = document.getElementById('deleteModal');
            let modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });
    </script>

</div>


