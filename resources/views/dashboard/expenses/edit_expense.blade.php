@extends('dashboard.layout')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Edit Expense</h1>
        <hr class="mb-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">

                        <div class="col-auto">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <form action="{{ route('dashboard.expenses.updateExpense', $data['expense']->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="supplier_name">Supplier Name</label>
                                <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $data['expense']->supplier_name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="supplier_contact">Supplier Contact info</label>
                                <br>
                                <textarea class="form-control" id="supplier_contact" rows="5" name="supplier_contact" required>{{ $data['expense']->supplier_contact }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="supporting_documents">Supporting Documents [Receipts or Quotes]</label>
                                <br>
                                <input type="file" class="form-control-file" id="supporting_documents" name="supporting_documents">
                                @if ($data['expense']->supporting_documents)
                                    <a href="{{ asset('storage/' . $data['expense']->supporting_documents) }}" target="_blank">View current document</a>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="products_purchased">Products Purchased</label>
                                <textarea class="form-control" id="products_purchased" rows="3" name="products_purchased" required>{{ $data['expense']->products_purchased }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <br>
                                <textarea class="form-control" id="description" name="description" required>{{ $data['expense']->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="amount">Total Amount</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $data['expense']->amount }}" required>
                            </div>
                            <div class="form-group mb-3 mb-4">
                                <label for="expense_type">Expense Type</label>
                                <input type="text" class="form-control" id="expense_type" name="expense_type" value="{{ $data['expense']->expense_type }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Expense</button>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div>
</div>
@endsection
