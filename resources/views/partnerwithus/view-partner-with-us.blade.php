@extends('Layout.main')
@section('title', 'Partner With Us')

@section('middle_content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('partner-with-us') }}" class="text-dark">Partner With Us</a> /
        </span> Partner With Us - Details
    </h4>

    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <strong>Dharamshala ID:</strong>
                    <p class="text-muted">{{ $data->dharamshala_id }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Name:</strong>
                    <p class="text-muted">{{ $data->name }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Dharamshala Name:</strong>
                    <p class="text-muted">{{ $data->dharamshala_name }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Phone Number:</strong>
                    <p class="text-muted">{{ $data->phone_number }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Email:</strong>
                    <p class="text-muted">{{ $data->email }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Address:</strong>
                    <p class="text-muted">{{ $data->address }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Dharamshala Address:</strong>
                    <p class="text-muted">{{ $data->dharamshala_address }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Authorize Signature:</strong>
                    <div class="mt-2">
                        <img src="http://127.0.0.1:8000/{{ $data->auth_sign }}" alt="Signature"
                             style="max-width: 120px; border-radius: 10px; border: 1px solid #ccc;">
                    </div>
                </div>

                <div class="col-md-6">
                    <strong>Authorize Photo:</strong>
                    <div class="mt-2">
                        <img src="http://127.0.0.1:8000/{{ $data->auth_img }}" alt="Photo"
                             style="max-width: 120px; border-radius: 10px; border: 1px solid #ccc;">
                    </div>
                </div>

                <div class="col-md-6">
                    <strong>Authorize Aadhar:</strong>
                    <p class="text-muted">{{ $data->auth_aadhar }}</p>
                </div>
                <!-- <div class="mt-2">
                    <button type="button" class="btn btn-secondary">
                        <a class="text-white" href="{{ route('partner-with-us') }}"> <i class="bx bx-x"></i> Back</a>
                    </button>

                    <button type="button" class="btn btn-secondary">
                        <a class="text-white" href="{{ route('popular-rituals') }}"> <i class="bx bx-x"></i> Approve</a>
                    </button>
                </div> -->
                <div class="mt-3 d-flex gap-2">
                    <!-- Back Button -->
                    <a href="{{ route('partner-with-us') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Back
                    </a>

                    <!-- Approve Button -->
                    <a href="{{ route('popular-rituals') }}" class="btn btn-success">
                        <i class="bx bx-check-circle me-1"></i> Approve
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
