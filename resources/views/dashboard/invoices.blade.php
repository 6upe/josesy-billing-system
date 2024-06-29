@extends('dashboard.layout') 
@section('content')
<div class="container">
    <h1>Invoices</h1>
    <a href="{{ route('dashboard.invoices.createInvoice') }}" class="btn btn-primary">Create Invoice</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quotation ID</th>
                <th>Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['invoices'] as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->quotation_id }}</td>
                <td>{{ $invoice->date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ ucfirst($invoice->status) }}</td>
                <td>{{ $invoice->total_amount }}</td>
                <td>
                    <a href="{{ route('dashboard.invoices.showInvoice', $invoice) }}" class="btn btn-info">View</a>
                    <a href="{{ route('dashboard.invoices.editInvoice', $invoice) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('dashboard.invoices.destroyInvoice', $invoice) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection