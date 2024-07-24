@extends('dashboard.layout')

@section('content')
<div class="container">
    <h1>Expense Details</h1>
    <div>
        <strong>Supplier Name:</strong> {{ $data['expense']->supplier_name }}
    </div>
    <div>
        <strong>Supplier Contact:</strong> {{ $data['expense']->supplier_contact }}
    </div>
    <div>
        <strong>Amount:</strong> {{ $data['expense']->amount }}
    </div>
    <div>
        <strong>Expense Type:</strong> {{ $data['expense']->expense_type }}
    </div>
    <div>
        <strong>Products Purchased:</strong> {{ $data['expense']->products_purchased }}
    </div>
    <a href="{{ asset('storage/' . $data['expense']->supporting_documents) }}" class="btn btn-outline-secondary mb-3" target="_blank">View Document</a>
    <br>

    <!-- Add more fields as necessary -->
    <a href="{{ route('dashboard.expenses') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
