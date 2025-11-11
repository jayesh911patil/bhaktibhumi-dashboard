@extends('Layout.main')
@section('title', 'Add Rooms')

@section('middle_content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('rooms') }}"
                class="text-dark">Rooms</a> /</span> Add Rooms</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Rooms</h5>

                </div>
                <div class="card-body">
                    <form action="{{ route('add-store-room') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Room Number -->
                        <div class="mb-3">
                            <label class="form-label">Room Number <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-hash"></i></span>
                                <input type="text" class="form-control" name="room_number" placeholder="Enter room number"
                                    value="{{ old('room_number') }}">
                            </div>
                            @error('room_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        


                         <!-- Room Type -->
                        <div class="mb-3">
                            <label class="form-label">Room Type <span class="text-danger">*</span></label>
                            <select name="room_type" class="form-control">
                                <option value="">Select Category</option>
                                <option value="Standard Room" {{ old('room_type') == 'Standard Room' ? 'selected' : '' }}>Standard Room</option>
                                <option value="Deluxe Room" {{ old('room_type') == 'Deluxe Room' ? 'selected' : '' }}>Deluxe Room</option>
                                <option value="Super Deluxe Room" {{ old('room_type') == 'Super Deluxe Room' ? 'selected' : '' }}>Super Deluxe Room</option>
                                <option value="Executive Room" {{ old('room_type') == 'Executive Room' ? 'selected' : '' }}>Executive Room</option>
                                <option value="Suite" {{ old('room_type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                            </select>
                            @error('room_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ac / Non-AC -->
                        <div class="mb-3">
                            <label class="form-label">Ac / Non-AC<span class="text-danger">*</span></label>
                            <select name="ac_no_ac" class="form-control">
                                <option value="">Select Room Type</option>
                                <option value="AC" {{ old('ac_no_ac') == 'AC' ? 'selected' : '' }}>AC</option>
                                <option value="Non-AC" {{ old('ac_no_ac') == 'Non-AC' ? 'selected' : '' }}>Non-AC</option>
                            </select>
                            @error('ac_no_ac')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                       

                        <!-- Bed capacity -->
                        <div class="mb-3">
                            <label class="form-label">Bed capacity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="bed_capacity" min="1"
                                value="{{ old('bed_capacity', 1) }}">
                            @error('bed_capacity')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Base Price -->
                        <div class="mb-3">
                            <label class="form-label">Rent <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="rent"
                                value="{{ old('rent') }}">
                            @error('rent')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <!-- Submit & Cancel -->
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-send"></i> Submit
                        </button>

                        <a href="{{ route('rooms') }}" class="btn btn-secondary">
                            <i class="bx bx-x"></i> Cancel
                        </a>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection