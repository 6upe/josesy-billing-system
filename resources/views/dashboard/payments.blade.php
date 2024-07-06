@extends('dashboard.layout')

@section('content')
<div class="container mx-5 py-5">
    <h1>Payments</h1>
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

    <a href="{{ route('dashboard.payments.registerPayment') }}" class="btn btn-primary mb-3">Register Payment</a>

    <table class="table">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Client</th>
                <th>Amount Paid</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['payments'] as $payment)
            <tr>
                <td>JTSL-QTN-2024-{{ $payment->invoice->id }}</td>
                <td>{{ $payment->invoice->quotation->client->name }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('dashboard.receipts.requestReceipt', $payment) }}" class="btn btn-warning">Receipt</a>
                    <!-- Add actions here if necessary -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
