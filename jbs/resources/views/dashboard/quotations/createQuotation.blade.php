@extends('dashboard.layout')
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Create New Quotation</h1>
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-12">
                <div class="app-card app-card-settings shadow-sm p-4">

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

                        <form method="POST" action="{{ route('dashboard.quotations.saveQuotation') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client or Company Name</label>
                                <select class="form-select" id="client_id" name="client_id" required>
                                    @foreach($data['clients'] as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tax_type" class="form-label">Tax Type</label>
                                <input type="text" class="form-control" id="tax_type" name="tax_type" required>
                            </div>
                            <div class="mb-3">
                                <label for="tax_amount" class="form-label">Tax Amount</label>
                                <input type="number" class="form-control" id="tax_amount" value="0" name="tax_amount" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="products" class="form-label">Products</label>
                            <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th>Name</th>
												<th>Quantity</th>
												<th>Total Amount</th>
                                                <th><a class="btn btn-sm btn-outline-primary" id="add-product-row">Add Product</a></th>
											</tr>
										</thead>
										<tbody id="product-table-body">

												<tr>
                                                    <td class="cell">
                                                        <select class="form-select mb-2 product-select" name="products[${index}][id]" required>
                                                            @foreach($data['products'] as $product)
                                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="cell">
                                                        <input type="number" class="form-control mb-2 quantity-input" name="products[${index}][quantity]" placeholder="Quantity" required>
                                                    </td>
                                                    <td class="cell">
                                                        <input type="number" class="form-control mb-2 total-amount-input" name="products[${index}][total_amount]" placeholder="Total Amount" step="0.01" required readonly>
                                                    </td>
                                                    <td class="cell">
                                                        <a href="#" class="remove-product-row">
                                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>


										</tbody>
									</table>
						        </div><!--//table-responsive-->
                            </div>


                            <div class="mb-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="number" class="form-control" id="total" name="total" step="0.01" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="grand_total" class="form-label">Grand Total</label>
                                <input type="number" class="form-control" id="grand_total" name="grand_total" step="0.01" required readonly>
                            </div>
                            <div class="d-flex w-100 justify-content-space-between">
                                <button type="submit" class="btn app-btn-primary px-5">Save Quotation</button>
                                <!-- <a class="btn app-btn-outline-secondary">Preview PDF</a>  -->
                                <a type="button" class="btn app-btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#pdfModal">
                                    Preview PDF
                                </a>               
                            </div>
                            
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculateTotalSum() {
        var totalSum = 0;
        var totalAmountInputs = document.querySelectorAll('.total-amount-input');
        totalAmountInputs.forEach(function(input) {
            var totalAmount = parseFloat(input.value);
            if (!isNaN(totalAmount)) {
                totalSum += totalAmount;
            }
        });

        var tax_amount = document.getElementById('tax_amount').value;
        var grand_total = parseFloat(tax_amount) + totalSum;
        
        document.getElementById('total').value = totalSum.toFixed(2);
        document.getElementById('grand_total').value = grand_total.toFixed(2);

        return totalSum.toFixed(2);
    }

    function attachRemoveRowListeners() {
        var removeIcons = document.querySelectorAll('.remove-product-row');
        removeIcons.forEach(function(icon) {
            icon.addEventListener('click', function(event) {
                event.preventDefault();
                var row = icon.closest('tr');
                if (row) {
                    row.remove();
                    calculateTotalSum();
                }
            });
        });
    }

    document.getElementById('tax_amount').addEventListener('change', function(){
        calculateTotalSum();
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity-input')) {
            var row = e.target.closest('tr');
            var price = parseFloat(row.querySelector('.product-select option:checked').dataset.price);
            var quantity = parseFloat(row.querySelector('.quantity-input').value);

            if (!isNaN(price) && !isNaN(quantity)) {
                var totalAmount = price * quantity;
                row.querySelector('.total-amount-input').value = totalAmount.toFixed(2);
            } else {
                row.querySelector('.total-amount-input').value = '';
            }

            var totalSum = calculateTotalSum();
        }
    });

    document.getElementById('add-product-row').addEventListener('click', function () {
        var productFieldsRow = document.getElementById('product-table-body');
        var index = productFieldsRow.children.length;

        var newProductRow = document.createElement('tr');
        newProductRow.innerHTML = `
            <td class="cell">
                <select class="form-select mb-2 product-select" name="products[${index}][id]" required>
                    @foreach($data['products']  as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="cell">
                <input type="number" class="form-control mb-2 quantity-input" name="products[${index}][quantity]" placeholder="Quantity" required>
            </td>
            <td class="cell">
                <input type="number" class="form-control mb-2 total-amount-input" name="products[${index}][total_amount]" placeholder="Total Amount" step="0.01" required readonly>
            </td>
            <td class="cell">
                <a href="#" class="remove-product-row">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </a>
            </td>
        `;

        productFieldsRow.appendChild(newProductRow);

        attachRemoveRowListeners(); // Reattach listeners to include the new row
        calculateTotalSum(); // Recalculate the total
    });

    attachRemoveRowListeners(); // Initial call to attach listeners
});
</script>

        <!-- Modal -->
        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">Quotation Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="pdfIframe" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="downloadPdf">Download PDF</button>
                        <button type="button" class="btn btn-success" id="sharePdf">Share with Client</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    function generatePDF() {
        const { jsPDF } = window.jspdf;

        const doc = new jsPDF();

        // Add content to the PDF
        doc.setFontSize(20);
        doc.text("Quotation #12345", 10, 10);

        doc.setFontSize(12);
        doc.text("Client Information:", 10, 20);
        doc.text("Name: John Doe", 10, 30);
        doc.text("Address: 123 Main St", 10, 40);
        doc.text("Email: john@example.com", 10, 50);

        doc.text("Quotation Details:", 10, 60);
        doc.text("Date: 2023-06-20", 10, 70);
        doc.text("Status: Pending", 10, 80);

        doc.text("Product", 10, 90);
        doc.text("Quantity", 50, 90);
        doc.text("Total Amount", 90, 90);
        doc.text("Product 1", 10, 100);
        doc.text("2", 50, 100);
        doc.text("$20.00", 90, 100);

        doc.text("Tax Type: GST", 10, 110);
        doc.text("Tax Amount: $2.00", 10, 120);
        doc.text("Total: $20.00", 10, 130);
        doc.text("Grand Total: $22.00", 10, 140);

        // Example of adding an image (make sure the image path is correct)
        // doc.addImage("path/to/signature.png", "PNG", 10, 150, 50, 20);
        // doc.addImage("path/to/stamp.png", "PNG", 10, 180, 50, 20);

        return doc;
    }

    document.querySelector('[data-bs-target="#pdfModal"]').addEventListener('click', function() {
        var doc = generatePDF();
        var pdfDataUri = doc.output('datauristring');
        var iframe = document.getElementById('pdfIframe');
        iframe.src = pdfDataUri;
    });

    document.getElementById('downloadPdf').addEventListener('click', function() {
        var doc = generatePDF();
        doc.save('quotation.pdf');
    });

    document.getElementById('sharePdf').addEventListener('click', function() {
        var doc = generatePDF();
        var pdfDataUri = doc.output('datauristring');
        window.location.href = "mailto:?subject=Quotation&body=Please find the attached quotation.%0A" + pdfDataUri;
    });
});
</script>




@endsection
