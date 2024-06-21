@extends('dashboard.layout') 
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">			    
        <h1 class="app-page-title">Add New Product or Service</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="settings-form" method="POST" action="{{ route('dashboard.products.saveProduct') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="product-name" class="form-label">Product/Service Name</label>
                                <input type="text" class="form-control" id="product-name" name="product_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="product-type" class="form-label">Product Type</label>
                                <select class="form-select" id="product-type" name="product_type" required>
                                    <option value="Service">Service</option>
                                    <option value="Product">Product</option>
                                    <option value="Course">Course</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product-price" class="form-label">Product Price or Rate</label>
                                <input type="number" class="form-control" id="product-price" name="product_price" required>
                            </div>
                            <div class="mb-3">
                                <label for="product-description" class="form-label">Product Description</label>
                                <textarea class="form-control" id="product-description" name="product_description" rows="6" required></textarea>
                            </div>
                            <button type="submit" class="btn app-btn-primary">Add Product</button>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->

@endsection
