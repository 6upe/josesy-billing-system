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
                    <h3 class="mb-3">Welcome, Slyvester</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-8">
                            <div>
                                <b>Verify Invoice Details</b> <br />
                                Double-check invoice amounts and due dates
                                before recording payments.
                            </div>
                        </div>
                        <!--//col-->

                        <div class="col-12 col-lg-4">
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
                                <!--//table-responsive-->


                                <script>
                                    
                                </script>


                            </div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                    <!-- <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button> -->
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
                        <div class="stats-figure">$12,628</div>
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
                        <div class="stats-figure">$2,250</div>
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
                        <div class="stats-figure">23</div>
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
                        <div class="stats-figure">6</div>
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
