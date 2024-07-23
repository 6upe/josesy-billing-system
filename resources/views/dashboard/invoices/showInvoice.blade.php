@extends('dashboard.layout')

@section('content')
<div class="container mx-5 py-5">
    <h1>Invoice Details </h1>
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-space-between">
            <div class="px-5">
                <div>
                    <h4>Client Details</h4>
                    <p><strong>Name:</strong> {{ $data['invoice']->quotation->client->name }}</p>
                    <p><strong>Email:</strong> {{ $data['invoice']->quotation->client->email }}</p>
                    <p><strong>Phone:</strong> {{ $data['invoice']->quotation->client->phone_number }}</p>
                    <p><strong>Address:</strong> {{ $data['invoice']->quotation->client->physical_address }}</p>
                    <div style="border: 0.5px solid lightgray; padding: 10px; border-radius: 10px;">
                        <p><strong>Controls</strong></p>
                        <hr>
                        <div class="d-flex justify-content-space-between">
                            <a href="{{ route('dashboard.invoices')}}" class="btn  mt-3 mx-2"><- Back to List</a>
                            <a href="#" class="btn btn-outline-secondary mt-3 mx-2" onclick="generatePdf()">Generate PDF</a>
                            <a href="#" class="btn btn-primary mt-3 mx-2" data-bs-toggle="modal" data-bs-target="#pdfModal">View PDF</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-5">
                <div>
                <p><strong>Invoice ID:</strong>JTSL-QTN-2024-{{ $data['invoice']->id }}</p>
                <p><strong>Date:</strong> {{ $data['invoice']->date }}</p>
                <p><strong>Due Date:</strong> {{ $data['invoice']->due_date }}</p>
                <p><strong>Status:</strong> {{ ucfirst($data['invoice']->status) }}</p>
                <p><strong>Total Amount:</strong> {{ $data['invoice']->total_amount }}</p>
                <p><strong>Paid Amount:</strong> {{ $data['invoice']->paid_amount }}</p>
                <p><strong>Balance:</strong> {{ $data['invoice']->balance }}</p>
                <p><strong>Discount:</strong> {{ $data['invoice']->discount }}</p>
                <p><strong>Comment:</strong> {{ $data['invoice']->comment }}</p>
                </div>
            </div>
        </div>
    </div>
    <h4>Products</h4>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['invoice']->quotation->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->pivot->total_amount }}</td>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Invoice Preview</h5>
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

<!-- Hidden Invoice Template -->
<div style="visibility: hidden;">
    <div id="invoiceTemplate">

    <div style="font-size: 5px; width: 185px; border: 0.1px solid black; margin: 10px; color: black; padding: 5px; ">

        <div style="text-align: center; margin: 0px;">
            <img src="{{ asset('assets/images/josesy-letterhead-invoice.png') }}" alt="Company Logo" width="170px" >
        </div>

        <div style="display: flex; justify-content: space-between; padding: 5px; margin: 0px;">
            <div style="margin: -1px;">
                <p style="margin: -1px; font-size: 3px;">Invoice JTSL-QTN-2024-<span id="template-invoice-id"></span></p>
                <p style="margin: -1px; font-size: 3px;"><strong>Date:</strong> <span id="template-date"></span></p>
                <p style="margin: -1px; font-size: 3px;"><strong>Due Date:</strong> <span id="template-due-date"></span></p>
                <p style="margin: -1px; font-size: 3px;"><strong>Status:</strong> <span id="template-status"></span></p>
            </div>
            <div style="margin: -1px;">
                <p  style="margin: -1px; font-size: 3px;"><strong>Name:</strong> <span id="template-client-name"></span></p>
                <p  style="margin: -1px; font-size: 3px;"><strong>Email:</strong> <span id="template-client-email"></span></p>
                <p  style="margin: -1px; font-size: 3px;"><strong>Phone:</strong> <span id="template-client-phone"></span></p>
                <p  style="margin: -1px; font-size: 3px;"><strong>Address:</strong> <span id="template-client-address"></span></p>
            </div> 
        </div>

        <table id="template-products" style="font-size: 4px; margin: 1px; width: 170px; padding: 5px;">
            <thead>
                <tr style="background-color: #f0f0f0;  color: black">
                    <th style=" font-size: 3px;  text-align: center; padding: 2px;">Item Description</th>
                    <th style=" font-size: 3px;  text-align: center; padding: 2px;">Quantity</th>
                    <th style=" font-size: 3px;  text-align: center; padding: 2px;">Unit Price</th>
                    <th style=" font-size: 3px;  text-align: center; padding: 2px;">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <!-- Product rows will be dynamically added here -->
            </tbody>

            <tfoot style="color: black; margin-top: 5px; background-color: #f0f0f0;  font-size: 3px;">
                <tr>
                    <td colspan="3" style=" text-align: right;"><strong>Total Amount</strong></td>
                    <td style="text-align: right;" id="template-total-amount"></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Paid Amount</strong></td>
                    <td style="text-align: right;"  id="template-paid-amount"></td>
                </tr>
                
                
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Discount</strong></td>
                    <td style="text-align: right;" id="template-discount"></td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Balance</strong></td>
                    <td style="text-align: right;" id="template-balance"></td>
                </tr>

            </tfoot>
            

        </table>

        <div style="margin-top: 5px;">
            <p style="margin: 1px; font-size: 4px;"><strong>Comment:</strong> <span id="template-comment"></span></p>
            <p style="margin: 1px; font-size: 4px;">Prepared By: <strong>{{ $data['user']->name}}</strong></p>
            <p style="margin: 1px; font-size: 4px;">Position: <strong>{{ $data['user']->position}}</strong></p>
            <p style="margin: 1px; font-size: 4px;">Email: <strong>{{ $data['user']->email}}</strong></p>
            <p style="margin: 1px; font-size: 4px;">Signature: <img src="{{ asset('assets/images/ceo-sign.png') }}" width="20px" alt="Signature"> <img  style="margin: 1px;" src="{{ asset('assets/images/josesy-stamp.png') }}" width="30px" alt="Stamp"></p>
        </div>

        <div style="margin: 1px;" class="text-center">
            <p style="margin: -1px; font-size: 3px;" class="text-danger">Thank you For your Business</p>
        </div>

    </div>

    </div>
</div>

<script>
function updateTemplate() {
    document.getElementById('template-invoice-id').innerText = '{{ $data['invoice']->id }}';
    document.getElementById('template-date').innerText = '{{ $data['invoice']->date }}';
    document.getElementById('template-due-date').innerText = '{{ $data['invoice']->due_date }}';
    document.getElementById('template-status').innerText = '{{ ucfirst($data['invoice']->status) }}';
    document.getElementById('template-client-name').innerText = '{{ $data['invoice']->quotation->client->name }}';
    document.getElementById('template-client-email').innerText = '{{ $data['invoice']->quotation->client->email }}';
    document.getElementById('template-client-phone').innerText = '{{ $data['invoice']->quotation->client->phone_number }}';
    document.getElementById('template-client-address').innerText = '{{ $data['invoice']->quotation->client->physical_address }}';
    
    const products = @json($data['invoice']->quotation->products);
    const productsTableBody = document.querySelector('#template-products tbody');
    productsTableBody.innerHTML = '';
    products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td  style="text-align: left; padding: 2px;  font-size: 3px;" >${product.name}</td>
            <td  style="text-align: right; padding: 2px;  font-size: 3px;" >${product.pivot.quantity}</td>
            <td  style="text-align: right; padding: 2px;  font-size: 3px;" >${product.price}</td>
            <td  style="text-align: right; padding: 2px;  font-size: 3px;" >${product.pivot.total_amount}</td>
        `;
        productsTableBody.appendChild(row);
    });

    document.getElementById('template-total-amount').innerText = '{{ $data['invoice']->total_amount }}';
    document.getElementById('template-paid-amount').innerText = '{{ $data['invoice']->paid_amount }}';
    document.getElementById('template-balance').innerText = '{{ $data['invoice']->balance }}';
    document.getElementById('template-discount').innerText = '{{ $data['invoice']->discount }}';
    document.getElementById('template-comment').innerText = '{{ $data['invoice']->comment }}';
}

async function generatePdf() {
    updateTemplate();
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF("p", "mm", [210, 297]);
    pdf.html(document.querySelector('#invoiceTemplate'), {
        callback: function (pdf) {
            const iframe = document.getElementById('pdfIframe');
            iframe.src = pdf.output('datauristring');
            document.getElementById('loading-spinner').style.display = 'none';
            iframe.style.display = 'block';
        }
    });
}

document.getElementById('pdfModal').addEventListener('shown.bs.modal', function () {
    generatePdf();
});

document.getElementById('downloadPdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF();
    pdf.html(document.querySelector('#invoiceTemplate'), {
        callback: function (pdf) {
            pdf.save('invoice.pdf');
        }
    });
});
</script>
@endsection
