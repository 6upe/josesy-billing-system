@extends('dashboard.layout')

@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Expenses</h1>
        <hr class="mb-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">

                        <a href="{{ route('dashboard.expenses.registerExpense') }}" class="btn btn-primary">Register
                            Expense</a>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Supplier Name</th>
                                    <th>Contact</th>
                                    <th>Amount</th>
                                    <th>Expense Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['expenses'] as $expense)
                                    <tr>
                                        <td>{{ $expense->supplier_name }}</td>
                                        <td>{{ $expense->supplier_contact }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->expense_type }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.expenses.showExpense', $expense->id) }}"
                                                class="btn btn-info">View</a>
                                            <a href="{{ route('dashboard.expenses.editExpense', $expense->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('dashboard.expenses.deleteExpense', $expense->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div>
</div>
@endsection