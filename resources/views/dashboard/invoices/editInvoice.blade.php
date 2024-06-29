@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Invoice</h1>
    <form action="{{ route('dashboard.invoices.updateInvoice', $invoice) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="quotation_id" class="form-label">Quotation</label>
            <select id="quotation_id" name="quotation_id" class="form-select" required>
                @foreach($quotations as $quotation)
                <option value="{{ $quotation->id }}" {{ $quotation->id == $invoice->quotation_id ? 'selected' : '' }}>{{ $quotation->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ $invoice->date }}" required>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" id="due_date" name="due_date" class="form-control" value="{{ $invoice->due_date }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ $invoice->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" id="total_amount" name="total_amount" class="form-control" value="{{ $invoice->total_amount }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="paid_amount" class="form-label">Paid Amount</label>
            <input type="number" id="paid_amount" name="paid_amount" class="form-control" value="{{ $invoice->paid_amount }}" step="0.01">
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" id="discount" name="discount" class="form-control" value="{{ $invoice->discount }}" step="0.01">
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea id="comment" name="comment" class="form-control">{{ $invoice->comment }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
