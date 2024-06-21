@extends('dashboard.layout') 
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">			    
        <h1 class="app-page-title">Edit Product or Service</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('dashboard.clients.updateClient', $data['client']->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $data['client']->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Client Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $data['client']->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Client Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $data['client']->phone_number }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="physical_address" class="form-label">Client Physical Address</label>
                                <input type="text" class="form-control" id="physical_address" name="physical_address" value="{{ $data['client']->physical_address }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Client</button>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->

@endsection
