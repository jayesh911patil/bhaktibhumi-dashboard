@extends('Layout.main')
@section('title', 'Edit Partner With Us')

@section('middle_content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('partner-with-us') }}" class="text-dark">Partner With Us</a> /
        </span>Edit Partner With Us
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Popular Ritual</h5>

                </div>
                <div class="card-body">
                    <form action="{{ route('edit-store-partner-with-us', ['partner_with_us_id' => $data->partner_with_us_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label" for="add-store-dharamshala">Name</label>
                            <div class="input-group input-group-merge">
                                <span id="add-store-dharamshala" class="input-group-text">
                                    <i class="bx bx-user"></i>
                                </span>
                                <input type="text" class="form-control" id="name" name="name" aria-label="Name"
                                    aria-describedby="dharamshala-name-icon" value="{{ $data->name }}" />
                            </div>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dharmashala name -->
                        <div class="mb-3">
                            <label class="form-label" for="add-store-dharamshala">Dharmashala Name</label>
                            <div class="input-group input-group-merge">
                                <span id="add-store-dharamshala" class="input-group-text">
                                    <i class="bx bx-building-house"></i>
                                </span>
                                <input type="text" class="form-control" id="dharamshala_name" name="dharamshala_name" aria-label="Name"
                                    aria-describedby="dharamshala-name-icon" value="{{ $data->dharamshala_name }}" />
                            </div>
                            @error('dharamshala_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label class="form-label" for="add-store-dharamshala">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span id="add-store-dharamshala" class="input-group-text">
                                    <i class="bx bx-phone"></i>
                                </span>
                                <input type="number" class="form-control" id="phone_number" name="phone_number" aria-label="Phone Number"
                                    aria-describedby="dharamshala-phone-icon" value="{{ $data->phone_number }}" />
                            </div>
                            @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label" for="add-store-dharamshala">Email</label>
                            <div class="input-group input-group-merge">
                                <span id="add-store-dharamshala" class="input-group-text">
                                    <i class="bx bx-envelope"></i>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" aria-label="Email"
                                    aria-describedby="dharamshala-name-icon" value="{{ $data->email }}" />
                            </div>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label" for="add-store-dharamshala">Address</label>
                            <div class="input-group input-group-merge">
                                <span id="add-store-dharamshala" class="input-group-text">
                                    <i class="bx bx-map"></i>
                                </span>
                                <input type="text" class="form-control" id="address" name="address" aria-label="Address"
                                    aria-describedby="dharamshala-name-icon" value="{{ $data->address }}" />
                            </div>
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dharamshala Address -->
                        <div class="mb-3">
                            <label class="form-label" for="add-store-dharamshala">Dharamshala Address</label>
                            <div class="input-group input-group-merge">
                                <span id="add-store-dharamshala" class="input-group-text">
                                    <i class="bx bx-map-pin"></i>
                                </span>
                                <input type="text" class="form-control" id="dharamshala_address" name="dharamshala_address" aria-label="Dharamshala Address"
                                    aria-describedby="dharamshala-name-icon" value="{{ $data->dharamshala_address }}" />
                            </div>
                            @error('dharamshala_address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Authorize Aadhar Number -->
                        <div class="mb-3">
                            <label class="form-label" for="add-store-dharamshala">Authorize Aadhar Number</label>
                            <div class="input-group input-group-merge">
                                <span id="add-store-dharamshala" class="input-group-text">
                                    <i class="bx bx-id-card"></i>
                                </span>
                                <input type="text" class="form-control" id="auth_aadhar" name="auth_aadhar" aria-label="Authorize Aadhar Number"
                                    aria-describedby="dharamshala-name-icon" value="{{ $data->auth_aadhar }}" />
                            </div>
                            @error('auth_aadhar')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btns">
                            <i class="bx bx-send"></i> Update
                        </button>

                        <button type="button" class="btn btn-secondary">
                            <a class="text-white" href="{{ route('partner-with-us') }}"> <i class="bx bx-x"></i> Cancel</a>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection