@extends('dashboard.layout')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Custom Report </h1>
        <hr class="mb-4">

        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">

                        <h5>Report Period - ({{ $data['start_date']->format('Y-m-d') }} - {{ $data['end_date']->format('Y-m-d') }})</h5>

                        <!-- Export PDF buttons -->
                        <a href="" class="btn btn-primary mb-3">Export Consolidated Report</a>

                        <!-- Back to Reports button -->
                        <a href="{{ route('dashboard.reports') }}" class="btn btn-secondary mb-3">Back to Reports</a>

                        <!-- Invoices Section -->
                         
                            <h2>Invoices</h2>
                            
                        
                        @if($data['invoices']->isEmpty())
                            <p>No invoices for this period.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Balance</th>
                                        <th>Discount</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['invoices'] as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->date }}</td>
                                            <td>{{ $invoice->quotation->client->name }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>{{ $invoice->total_amount }}</td>
                                            <td>{{ $invoice->paid_amount }}</td>
                                            <td>{{ $invoice->balance }}</td>
                                            <td>{{ $invoice->discount }}</td>
                                            <td>{{ $invoice->comment }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Quotations Section -->
                        <h2>Quotations</h2>
                        @if($data['quotations']->isEmpty())
                            <p>No quotations for this period.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Total Amount</th>
                                        <th>Discount</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['quotations'] as $quotation)
                                        <tr>
                                            <td>{{ $quotation->id }}</td>
                                            <td>{{ $quotation->date }}</td>
                                            <td>{{ $quotation->client->name }}</td>
                                            <td>{{ $quotation->grand_total }}</td>
                                            <td>{{ $quotation->discount }}</td>
                                            <td>{{ $quotation->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Expenses Section -->
                        <h2>Expenses</h2>
                        @if($data['expenses']->isEmpty())
                            <p>No expenses for this period.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Created By</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier Contact</th>
                                        <th>Products Purchased</th>
                                        <th>Amount</th>
                                        <th>Expense Type</th>
                                        <th>Date of Expense</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['expenses'] as $expense)
                                        <tr>
                                            <td>{{ $expense->id }}</td>
                                            <td>{{ $expense->creator->name }}</td>
                                            <td>{{ $expense->supplier_name }}</td>
                                            <td>{{ $expense->supplier_contact }}</td>
                                            <td>{{ $expense->products_purchased }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->expense_type }}</td>
                                            <td>{{ $expense->date_of_expense }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Payments Section -->
                        <h2>Payments</h2>
                        @if($data['payments']->isEmpty())
                            <p>No payments for this period.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['payments'] as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->created_at }}</td>
                                            <td>{{ $payment->invoice->quotation->client->name }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ $payment->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
