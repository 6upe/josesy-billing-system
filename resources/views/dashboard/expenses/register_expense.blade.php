@extends('dashboard.layout')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Register Expense</h1>
        <hr class="mb-4">
        
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">

                        <form action="{{ route('dashboard.expenses.saveExpense') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="supplier_name">Supplier Name</label>
                                <input type="text" class="form-control" id="supplier_name" name="supplier_name"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="supplier_contact">Supplier Contact</label>
                                <input type="text" class="form-control" id="supplier_contact" name="supplier_contact"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="supporting_documents">Supporting Documents</label>
                                <input type="file" class="form-control-file" id="supporting_documents"
                                    name="supporting_documents">
                            </div>

                            <div class="form-group">
                                <label for="products_purchased">Products Purchased</label>
                                <textarea class="form-control" id="products_purchased" name="products_purchased"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="amount">Total Amount</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="unit_price">Unit Price</label>
                                <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="expense_type">Expense Type</label>
                                <input type="text" class="form-control" id="expense_type" name="expense_type" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div>
</div>

@endsection