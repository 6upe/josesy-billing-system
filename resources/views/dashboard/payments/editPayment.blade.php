@extends('dashboard.layout')

@section('content')
<div class="container mx-5 py-5">
    <h1>Edit Payment</h1>
    <form action="{{ route('dashboard.payments.updatePayment', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="invoice_id" class="form-label">Invoice</label>
            <select class="form-select" id="invoice_id" name="invoice_id" required>
                <option value="">Select Invoice</option>
                @foreach($invoices as $invoice)
                <option value="{{ $invoice->id }}" {{ $payment->invoice_id == $invoice->id ? 'selected' : '' }}>Invoice #JTSL-QTN-2024-{{ $invoice->id }} - {{ $invoice->quotation->client->name }} - Balance: {{ $invoice->balance }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount Paid</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $payment->amount }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Payment</button>
    </form>
</div>
@endsection
