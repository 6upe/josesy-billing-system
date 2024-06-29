@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invoice Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $data['invoice']->id }}</p>
            <p><strong>Quotation ID:</strong> {{ $data['invoice']->quotation_id }}</p>
            <p><strong>Date:</strong> {{ $data['invoice']->date }}</p>
            <p><strong>Due Date:</strong> {{ $data['invoice']->due_date }}</p>
            <p><strong>Status:</strong> {{ ucfirst($data['invoice']->status) }}</p>
            <p><strong>Total Amount:</strong> {{ $data['invoice']->total_amount }}</p>
            <p><strong>Paid Amount:</strong> {{ $data['invoice']->paid_amount }}</p>
            <p><strong>Discount:</strong> {{ $data['invoice']->discount }}</p>
            <p><strong>Comment:</strong> {{ $data['invoice']->comment }}</p>
        </div>
    </div>
    <a href="{{ route('dashboard.invoices') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
