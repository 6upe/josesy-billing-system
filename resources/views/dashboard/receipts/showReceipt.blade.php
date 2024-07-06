@extends('dashboard.layout')

@section('content')
<div class="container mx-5 py-5">
    <h1>Receipt Details</h1>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Receipt ID:</strong> {{ $data['receipt']->id }}</p>
            <p><strong>Invoice ID:</strong> {{ $data['payment']->invoice_id }}</p>
            <p><strong>Amount Paid:</strong> {{ $data['payment']->amount }}</p>
            <p><strong>Date:</strong> {{ $data['receipt']->created_at }}</p>
        </div>
    </div>
</div>
@endsection
