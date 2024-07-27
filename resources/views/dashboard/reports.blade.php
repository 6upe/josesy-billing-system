@extends('dashboard.layout')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Reports Dashboard</h1>
        <hr class="mb-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <h2>Select Report Type</h2>
                        <a href="{{ route('dashboard.reports.monthly') }}" class="btn btn-primary">Monthly Report</a>
                        <a href="{{ route('dashboard.reports.annual') }}" class="btn btn-primary">Annual Report</a>
                        <a href="{{ route('dashboard.reports.weekly') }}" class="btn btn-primary">Weekly Report</a>
                        <form action="{{ route('dashboard.reports.custom') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Generate Custom Report</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
