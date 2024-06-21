@extends('dashboard.layout')
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
       
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Quotations</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center" method="GET" action="{{ route('dashboard.quotations') }}">
                                <div class="col-auto">
                                    <input type="text" id="search-quotations" name="search" class="form-control search-quotations" placeholder="Search" value="{{ $search ?? '' }}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('dashboard.quotations.createQuotation') }}" class="btn app-btn-primary">Create New Quotation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="quotations-table-tab-content">
            <div class="tab-pane fade show active" id="quotations-all" role="tabpanel" aria-labelledby="quotations-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">

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

                        <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Tax Type</th>
                                    <th>Tax Amount</th>
                                    <th>Total</th>
                                    <th>Grand Total</th>
                                    <th>Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['quotations'] as $quotation)
                                    <tr>
                                        <td class="cell">{{ $quotation->client->name }}</td>
                                        <td class="cell">{{ $quotation->date }}</td>
                                        <td class="cell">{{ ucfirst($quotation->status) }}</td>
                                        <td class="cell">{{ $quotation->tax_type }}</td>
                                        <td class="cell">{{ $quotation->tax_amount }}</td>
                                        <td class="cell">{{ $quotation->total }}</td>
                                        <td class="cell">{{ $quotation->grand_total }}</td>
                                        <td class="cell">
                                            <table class="table app-table-hover mb-0 text-left">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($quotation->products as $productGroup)
                                                        @php
                                                            $foundProduct = $data['products']->firstWhere('id', $productGroup->pivot->product_id);
                                                        @endphp
                                                        @if ($foundProduct)
                                                            <tr>
                                                                <td>{{ $foundProduct->name }}</td>
                                                                <td>{{ $productGroup->pivot->quantity }}</td>
                                                                <td>{{ $foundProduct->price }}</td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-danger">Product not found</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="cell">
                                            <a href="{{ route('dashboard.quotations.editQuotation', $quotation->id) }}">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </a>
                                            <br><br>
                                            <form action="{{ route('dashboard.quotations.deleteQuotation', $quotation->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background-color: white; color: red;">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        </div>
                    </div>        
                </div>
                <nav class="app-pagination">
                    {{ $data['quotations']->withQueryString()->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection
