@extends('dashboard.layout')
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Quotation</h1>
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

                        <form id="quotationForm" method="POST" action="{{ route('dashboard.quotations.updateQuotation', $data['quotation']->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client or Company Name</label>
                                <select class="form-select" id="client_id" name="client_id" required>
                                    @foreach($data['clients'] as $client)
                                        <option value="{{ $client->id }}" {{ $client->id == $data['quotation']->client_id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="qtn-date" name="date" value="{{$data['quotation']->date}}" required>
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
                                <input type="text" value="{{$data['quotation']->tax_type}}" class="form-control" id="tax_type" name="tax_type" required>
                            </div>
                            <div class="mb-3">
                                <label for="tax_amount" class="form-label">Tax Amount</label>
                                <input type="number"  value="{{$data['quotation']->tax_amount}}" class="form-control" id="tax_amount" value="0" name="tax_amount" step="0.01" required>
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

                                            @foreach($data['quotation']->products as $index => $product)
                                                <tr>
                                                    <td class="cell">
                                                        <select class="form-select mb-2 product-select" name="products[{{ $index }}][id]" required>
                                                            @foreach($data['products'] as $productOption)
                                                                <option value="{{ $productOption->id }}" data-price="{{ $productOption->price }}" 
                                                                    {{ $productOption->id == $product->id ? 'selected' : '' }}>
                                                                    {{ $productOption->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="cell">
                                                        <input type="number" class="form-control mb-2 quantity-input" name="products[{{ $index }}][quantity]" value="{{ $product->pivot->quantity }}" placeholder="Quantity" required>
                                                    </td>
                                                    <td class="cell">
                                                        <input type="number" class="form-control mb-2 total-amount-input" name="products[{{ $index }}][total_amount]" value="{{ $product->pivot->total_amount }}" placeholder="Total Amount" step="0.01" required readonly>
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
                                            @endforeach

										</tbody>
									</table>
						        </div><!--//table-responsive-->
                            </div>

                            <div class="mb-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="number" value="{{$data['quotation']->total}}" class="form-control"  id="total" name="total" step="0.50" required readonly>
                            </div>

                            <div class="mb-3">
                                <label for="grand_total" class="form-label">Grand Total</label>
                                <input type="number" value="{{$data['quotation']->grand_total}}"  class="form-control" id="grand_total" name="grand_total"  required readonly>
                            </div>

                            <div class="d-flex w-100 justify-content-space-between">
                                <button type="submit" class="btn app-btn-primary px-5">Update Quotation</button>
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


<!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Quotation Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loading-spinner" class="spinner-border text-center" role="status">
                    <span class="visually-hidden text-success">Loading...</span>
                </div>
                <iframe id="pdfIframe" style="width: 100%; height: 500px; display: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="downloadPdf">Download PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Quotation Template -->
<div style="visibility: hidden;">
    <div id="quotationTemplate">
        <div style="font-size: 5px; width: 185px; border: 0.1px solid black; margin: 0.5px; color: black; padding: 2px;">
            <div style="text-align: center; margin: 0px;">
                <img src="{{ asset('assets/images/josesy-letterhead-quotation.png') }}" alt="Company Logo" width="170px" >
            </div>
            <div style="display: flex; justify-content: space-between; padding: 5px; margin: 0px;">
                <div style="margin: -1px;">
                    <p style="margin: -1px; font-size: 3px;"><strong>Client Name :</strong> <span id="template-client-name"></span></p>
                    <p style="margin: -1px; font-size: 3px;"><strong>Client Email :</strong> <span id="template-client-email"></span></p>
                    <p style="margin: -1px; font-size: 3px;"><strong>Client Phone :</strong> <span id="template-client-phone"></span></p>
                    <p style="margin: -1px; font-size: 3px;"><strong>Client Address :</strong> <span id="template-client-address"></span></p>
                </div>
                <div style="margin: -1px;">
                    <p style="margin: -1px; font-size: 3px;"><strong>Date :</strong> <span id="template-qtn-date"></span></p>
                    <p style="margin: -1px; font-size: 3px;"><strong>Quotation # :</strong> <span id="template-qtn-number"></span> </p>
                    <p style="margin: -1px; font-size: 3px;"><strong>Status :</strong> <span id="template-qtn-status"></span> </p>
                </div> 
            </div>

            <table style="font-size: 4px; margin: 1px 0; width: 170px; padding: 5px;">
                <thead>
                    <tr style="background-color: #f0f0f0;  color: black">
                        <th style="  text-align: center; padding: 2px;">Item Description</th>
                        <th style="  text-align: center; padding: 2px;">Quantity</th>
                        <th style="  text-align: center; padding: 2px;">Unit Price</th>
                        <th style="  text-align: center; padding: 2px;">Total Price</th>
                    </tr>
                </thead>
                <tbody id="template-items">
                    <!-- Dynamically added items will appear here -->
                </tbody>
                <tfoot style="color: black; margin-top: 5px; background-color: #f0f0f0;">
                    <tr>
                        <td colspan="3" style=" text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;" id="template-total"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Tax Type</strong></td>
                        <td style="text-align: right;" id="template-tax-type"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Tax Amount</strong></td>
                        <td style="text-align: right;" id="template-tax-amount"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Grand Total</strong></td>
                        <td style="text-align: right;" id="template-grand-total"></td>
                    </tr>
                </tfoot>
            </table>

            <div style="margin-top: 5px;">
                <p style="margin: 1px; font-size: 4px;">Prepared By: <strong>Sylvester Lunda</strong></p>
                <p style="margin: 1px; font-size: 4px;">Signature: <img src="{{ asset('assets/images/ceo-sign.png') }}" width="20px" alt="Signature"> <img  style="margin: 1px;" src="{{ asset('assets/images/josesy-stamp.png') }}" width="30px" alt="Stamp"></p>
                
                
            </div>

            <div style="margin: 1px;" class="text-center">
                <p style="margin: -1px; font-size: 3px;" class="text-danger">Thank you For your Business</p>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {


    // Store client data
    var clients = {
        @foreach($data['clients'] as $client)
        "{{ $client->id }}": {
            "name": "{{ $client->name }}",
            "email": "{{ $client->email }}",
            "phone": "{{ $client->phone_number }}",
            "address": "{{ $client->physical_address }}"
        },
        @endforeach
    };

    

    function updateTemplate() {
        document.getElementById('template-qtn-date').innerText = document.getElementById('qtn-date').value;

        let lastQuoteId = {{$data['lastQuotationId']}}
        

        document.getElementById('template-qtn-number').innerText = 'JTSL-QTN-2024-' + parseInt(lastQuoteId + 1);
       
        document.getElementById('template-qtn-status').innerText = document.getElementById('status').value;

        var selectedClientID = document.getElementById('client_id').value;
        var selectedClient = clients[selectedClientID];

        document.getElementById('template-client-name').innerText = selectedClient.name;
        document.getElementById('template-client-email').innerText = selectedClient.email;
        document.getElementById('template-client-phone').innerText = selectedClient.phone;
        document.getElementById('template-client-address').innerText = selectedClient.address;


        var itemsBody = document.getElementById('template-items');
        itemsBody.innerHTML = '';
        document.querySelectorAll('#product-table-body tr').forEach(function (row) {
            var description = row.querySelector('.product-select option:checked').text;
            var quantity = row.querySelector('.quantity-input').value;
            var unitPrice = row.querySelector('.product-select option:checked').dataset.price;
            var totalPrice = row.querySelector('.total-amount-input').value;
            itemsBody.innerHTML += `
                <tr style="color: black;">
                    <td>${description}</td>
                    <td style="text-align: right;">${quantity}</td>
                    <td style="text-align: right;">${parseFloat(unitPrice).toFixed(2)}</td>
                    <td style="text-align: right;">${parseFloat(totalPrice).toFixed(2)}</td>
                </tr>
            `;
        });
        document.getElementById('template-total').innerText = document.getElementById('total').value;
        document.getElementById('template-tax-type').innerText = document.getElementById('tax_type').value;
        document.getElementById('template-tax-amount').innerText = document.getElementById('tax_amount').value;
        document.getElementById('template-grand-total').innerText = document.getElementById('grand_total').value;
        
    }

    updateTemplate();

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
                    updateTemplate();
                }
            });
        });
    }

    document.getElementById('tax_amount').addEventListener('change', function(){
        calculateTotalSum();
        updateTemplate();
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
            updateTemplate();
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
        updateTemplate();
    });

    attachRemoveRowListeners(); // Initial call to attach listeners

    function generatePDF(callback) {
    const { jsPDF } = window.jspdf;

    let doc = new jsPDF("p", "mm", [210, 297]);

    let pdfjs = document.querySelector("#quotationTemplate");
   

    doc.html(pdfjs, {
        callback: function (doc) {
            callback(doc);

        },
        x: 12,
        y: 12,
    });
}
var pdfModal = document.getElementById('pdfModal');
var pdfIframe = document.getElementById('pdfIframe');
var loadingSpinner = document.getElementById('loading-spinner');

pdfModal.addEventListener('show.bs.modal', function () {
    // Show loading spinner and hide iframe
    loadingSpinner.style.display = 'block';
    pdfIframe.style.display = 'none';

    try {
        generatePDF(function(doc) {
            setTimeout(function() {
                var pdfDataUri = doc.output('datauristring');
                pdfIframe.src = pdfDataUri;
                doc.save('JTSL-QTN-2024');
                // Hide loading spinner and show iframe
                loadingSpinner.style.display = 'none';
                pdfIframe.style.display = 'block';
            }, 2000); // Adjust the delay as needed
        });
        console.log('PDF generated!');
        
    } catch (error) {
        console.error('Error generating PDF:', error);
        // Hide loading spinner if there's an error
        loadingSpinner.style.display = 'none';
    }
});



    document.getElementById('downloadPdf').addEventListener('click', async function() {
        const quotationId = 1; // Replace with your selected quotation ID
        const quotation = await fetchQuotationDetails(quotationId);
        if (quotation) {
            var doc = generatePDF(quotation);
            doc.save('JTSL-QTN-2024');
        }
    });

    document.getElementById('quotationForm').addEventListener('change', function () {
        updateTemplate();
    });

    // document.getElementById('preview-pdf').addEventListener('click', function () {
    //     // updateTemplate();
    //     // Show modal or trigger any other preview functionality
    // });

});

   

</script>




@endsection
