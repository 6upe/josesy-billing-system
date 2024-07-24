@extends('dashboard.layout') 
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title"></h1>

        <div
            class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration"
            role="alert"
        >
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Welcome, {{ $data['user']->name }}</h3>
                    <div class="row gx-5 gy-3">
                        <div class="tip-container" id="tip-container" class="col-12 col-lg-8">
                            <div class="tip">
                                <b>Verify Invoice Details</b> <br />
                                Double-check invoice amounts and due dates
                                before recording payments.
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const tips = [
                                    '<b>Verify Invoice Details</b><br />Double-check invoice amounts and due dates before recording payments.',
                                    '<b>Maintain Customer Records</b><br />Keep customer contact details up to date for accurate billing and communication.',
                                    '<b>Set Up Payment Reminders</b><br />Automate payment reminders to reduce late payments.',
                                    '<b>Regularly Reconcile Accounts</b><br />Reconcile your accounts regularly to ensure all transactions are recorded accurately.',
                                    '<b>Monitor Cash Flow</b><br />Track your cash flow to maintain a healthy financial status.',
                                    '<b>Utilize Reporting Tools</b><br />Use reporting tools to analyze billing and payment trends.',
                                    '<b>Offer Multiple Payment Options</b><br />Provide customers with various payment options to facilitate easy payments.',
                                    '<b>Ensure Data Security</b><br />Protect customer data with strong security measures.',
                                    '<b>Stay Compliant</b><br />Ensure your billing system complies with relevant financial regulations.',
                                    '<b>Provide Customer Support</b><br />Offer reliable customer support for billing-related queries.'
                                ];

                                let currentTipIndex = 0;
                                const tipContainer = document.getElementById('tip-container');

                                function showNextTip() {
                                    currentTipIndex = (currentTipIndex + 1) % tips.length;
                                    tipContainer.innerHTML = `<div class="tip">${tips[currentTipIndex]}</div>`;
                                }

                                setInterval(showNextTip, 2000);
                            });
                        </script>
                        <!--//col-->

                        <!-- <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <sub class="text-danger">
                                    19 Jun, 7:12am UTC · Disclaimer
                                </sub>
                            </div>
                            <div class="mb-3 w-100">
                                <select
                                    class="form-select form-select-sm ms-auto d-inline-flex w-auto"
                                >
                                    <option value="1" selected>
                                        USD -> ZMW
                                    </option>
                                    <option value="2">GBP -> ZMW</option>
                                    <option value="3" selected>
                                        USD -> ZMW
                                    </option>
                                    <option value="4">GBP -> ZMW</option>
                                </select>

                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td
                                                    class="stat-cell fw-bold text-success"
                                                >
                                                    $1.00
                                                </td>
                                                <td
                                                    class="stat-cell fw-bold text-success"
                                                >
                                                    25.78 ZMW
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div> -->
                        <!--//col-->
                    </div>
                   
                    
                </div>
                <!--//app-card-body-->
            </div>
            <!--//inner-->
        </div>
        <!--//app-card-->

        <div class="row g-4 mb-4">
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Sales</h4>
                        <div class="fw-bold fs-4 text-success">ZMW {{ $data['totalIncome'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Balances</h4>
                        <div class="fw-bold fs-4 text-success">ZMW {{ $data['totalBalance'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Quotations</h4>
                        <div class="fw-bold fs-4 text-success">{{ $data['totalQuotations'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Invoices</h4>
                        <div class="fw-bold fs-4 text-success">{{ $data['totalInvoices'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Expenses</h4>
                        <div class="fw-bold fs-4 text-success">{{ $data['totalExpense'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Available Revenue</h4>
                        <div class="fw-bold fs-4 text-success">{{ $data['availableRevenue'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
        </div>

       
    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

@endsection
