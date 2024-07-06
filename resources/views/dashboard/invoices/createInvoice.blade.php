@extends('dashboard.layout') 

@section('content')
<div class="container">
    <h1>Create Invoice</h1>
    <form action="{{ route('dashboard.invoices.saveInvoice') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <p>Client Name: <span class="text-success fw-bold" id="client_name"></span></p>
        </div>
        <div class="mb-3">
            <h4>Products</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="products_table_body">
                    <!-- Product rows will be added here -->
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            <label for="quotation_id" class="form-label">Quotation</label>
            <select id="quotation_id" name="quotation_id" class="form-select" required>
            <option value="0">Select Quotation</option>
                @foreach($data['quotations'] as $quotation)
                    <option value="{{ $quotation->id }}">JTSL-QTN-2024-{{ $quotation->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" id="due_date" name="due_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="overdue">Overdue</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="paid_amount" class="form-label">Paid Amount</label>
            <input type="number" id="paid_amount" name="paid_amount" class="form-control" step="0.01">
        </div>
        
        <div class="mb-3">
            <label for="balance" class="form-label">Balance</label>
            <input type="number" id="balance" name="balance" class="form-control" step="0.01" readonly>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" id="discount" name="discount" class="form-control" step="0.01">
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" id="total_amount" name="total_amount" class="form-control" step="0.01" required readonly>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea id="comment" name="comment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<script>
    document.getElementById('quotation_id').addEventListener('input', function () {
        let quotationId = this.value;
        let quotations = @json($data['quotations']);
        let clients = @json($data['clients']);
        let selectedQuotation = quotations.find(q => q.id == quotationId);
        let selectedClient = clients.find(c => c.id == selectedQuotation.client_id);

        console.log('Products: ', selectedQuotation.products);

        document.getElementById('client_name').innerText = selectedClient.name;

        if (selectedQuotation) {
            document.getElementById('total_amount').value = selectedQuotation.total;
            populateProductsTable(selectedQuotation.products);
        }
    });

    function populateProductsTable(products) {
        let tableBody = document.getElementById('products_table_body');
        tableBody.innerHTML = '';
        products.forEach(product => {
            let row = `<tr>
                <td>${product.name}</td>
                <td>${product.pivot.quantity}</td>
                <td>${product.price}</td>
                <td>${product.pivot.total_amount}</td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    }

    document.getElementById('paid_amount').addEventListener('input', calculateBalance);
    document.getElementById('discount').addEventListener('input', calculateBalance);

    function calculateBalance() {
        let totalAmount = parseFloat(document.getElementById('total_amount').value) || 0;
        let paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
        let discount = parseFloat(document.getElementById('discount').value) || 0;
        let balance = (totalAmount - paidAmount) - discount;
        document.getElementById('balance').value = balance.toFixed(2);
    }
</script>
@endsection
