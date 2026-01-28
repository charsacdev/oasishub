@extends('homepages.header')
@section('content')

<main class="main">
    <div class="container">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Pre Order
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>PRE ORDER</h1>
            </div>
        </div>

        <div class="container py-5">
            <h3 class="mb-4 text-center">Pre-Order a Product</h3>

            <form id="preorderForm" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                    </div>
                   
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    
                    <div class="col-md-6">
                        <input type="text" name="product_category" class="form-control" placeholder="Product Category" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="col-12">
                        <textarea name="product_description" class="form-control" rows="3" placeholder="Describe the product..." required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Upload Product Images</label>
                        <input type="file" name="product_images[]" class="form-control" multiple accept="image/*" required>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" id="submitBtn" class="btn btn-dark px-5">
                            <span class="spinner-border spinner-border-sm" id="loadingSpinner"></span>
                            Submit Pre-Order
                        </button>
                    </div>
                </div>
            </form>

            <div id="responseMessage" class="alert mt-4 d-none"></div>
        </div>

        <script>
        $(document).ready(function () {
            $('#preorderForm').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                $('#submitBtn').attr('disabled', true);
                $('#submitBtn').text('Processing...');
                $('#loadingSpinner').removeClass('d-none');
                $('#responseMessage').addClass('d-none');

                $.ajax({
                    url: "{{route('preorder.store')}}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#responseMessage').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                        $('#preorderForm')[0].reset();
                    },
                    error: function (xhr) {
                        let msg = xhr.responseJSON?.message || "Something went wrong.";
                        $('#responseMessage').removeClass('d-none alert-success').addClass('alert-danger').text(msg);
                    },
                    complete: function () {
                        $('#submitBtn').attr('disabled', false);
                        $('#loadingSpinner').addClass('d-none');
                    }
                });
            });
        });
        </script>
    </div>
</main>
@endsection
