@extends('dashboard.layout')

@section('content')
<div class="container">
    <h1>Edit Expense</h1>
    <form action="{{ route('dashboard.expenses.updateExpense', $data['expense']->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $data['expense']->supplier_name }}" required>
        </div>
        <div class="form-group">
            <label for="supplier_contact">Supplier Contact</label>
            <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" value="{{ $data['expense']->supplier_contact }}" required>
        </div>
        <div class="form-group">
            <label for="supporting_documents">Supporting Documents</label>
            <input type="file" class="form-control-file" id="supporting_documents" name="supporting_documents">
        </div>
        <div class="form-group">
            <label for="quotes">Quotes</label>
            <input type="file" class="form-control-file" id="quotes" name="quotes">
        </div>
        <div class="form-group">
            <label for="invoices">Invoices</label>
            <input type="file" class="form-control-file" id="invoices" name="invoices">
        </div>
        <div class="form-group">
            <label for="receipts">Receipts</label>
            <input type="file" class="form-control-file" id="receipts" name="receipts">
        </div>
        <div class="form-group">
            <label for="products_purchased">Products Purchased</label>
            <textarea class="form-control" id="products_purchased" name="products_purchased" required>{{ $data['expense']->products_purchased }}</textarea>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $data['expense']->amount }}" required>
        </div>
        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" value="{{ $data['expense']->unit_price }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $data['expense']->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="expense_type">Expense Type</label>
            <input type="text" class="form-control" id="expense_type" name="expense_type" value="{{ $data['expense']->expense_type }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
