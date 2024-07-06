@extends('dashboard.layout')

@section('content')
<div class="container mx-5 py-5">
    <h1>Statement Details</h1>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Statement ID:</strong> {{ $data['statement']->id }}</p>
            <p><strong>Invoice ID:</strong> {{ $data['statement']->invoice_id }}</p>
            <p><strong>Total Amount:</strong> {{ $data['statement']->total_amount }}</p>
            <p><strong>Paid Amount:</strong> {{ $data['statement']->paid_amount }}</p>
            <p><strong>Balance:</strong> {{ $data['statement']->balance }}</p>
            <p><strong>Date:</strong> {{ $data['statement']->created_at }}</p>
        </div>
    </div>
</div>
@endsection
