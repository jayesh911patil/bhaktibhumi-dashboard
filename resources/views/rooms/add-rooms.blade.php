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

                        <!-- Room Title -->
                        <div class="mb-3">
                            <label class="form-label">Room Title <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                                <input type="text" class="form-control" name="room_title" placeholder="Deluxe AC Room"
                                    value="{{ old('room_title') }}">
                            </div>
                            @error('room_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Room Type -->
                        <div class="mb-3">
                            <label class="form-label">Room Type <span class="text-danger">*</span></label>
                            <select name="room_type" class="form-control">
                                <option value="">Select Room Type</option>
                                <option value="AC" {{ old('room_type') == 'AC' ? 'selected' : '' }}>AC</option>
                                <option value="Non-AC" {{ old('room_type') == 'Non-AC' ? 'selected' : '' }}>Non-AC</option>
                            </select>
                            @error('room_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control">
                                <option value="">Select Category</option>
                                <option value="Deluxe" {{ old('category') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                <option value="Standard" {{ old('category') == 'Standard' ? 'selected' : '' }}>Standard</option>
                                <option value="Suite" {{ old('category') == 'Suite' ? 'selected' : '' }}>Suite</option>
                            </select>
                            @error('category')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Total Rooms -->
                        <div class="mb-3">
                            <label class="form-label">Total Rooms <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="total_rooms" min="1"
                                value="{{ old('total_rooms', 1) }}">
                            @error('total_rooms')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Base Price -->
                        <div class="mb-3">
                            <label class="form-label">Base Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="base_price"
                                value="{{ old('base_price') }}">
                            @error('base_price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Extra Bed Price -->
                        <div class="mb-3">
                            <label class="form-label">Extra Bed Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="extra_bed_price"
                                value="{{ old('extra_bed_price') }}">
                            @error('extra_bed_price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Max Adults -->
                        <div class="mb-3">
                            <label class="form-label">Max Adults <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="max_adults"
                                value="{{ old('max_adults', 2) }}">
                            @error('max_adults')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Max Children -->
                        <div class="mb-3">
                            <label class="form-label">Max Children <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="max_children"
                                value="{{ old('max_children', 0) }}">
                            @error('max_children')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bed Type -->
                        <div class="mb-3">
                            <label class="form-label">Bed Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bed_type"
                                value="{{ old('bed_type') }}" placeholder="e.g., Double Bed">
                            @error('bed_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Amenities -->
                        <div class="mb-3">
                            <label class="form-label">Amenities <span class="text-danger">*</span></label>
                            <textarea name="amenities" class="form-control" rows="2" placeholder="WiFi, TV, Hot Water">{{ old('amenities') }}</textarea>
                            @error('amenities')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter room description">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Floor Number -->
                        <div class="mb-3">
                            <label class="form-label">Floor Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="floor_number"
                                value="{{ old('floor_number') }}" placeholder="e.g., 1st Floor">
                            @error('floor_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Room Size -->
                        <div class="mb-3">
                            <label class="form-label">Room Size (sq ft) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="room_size"
                                value="{{ old('room_size') }}">
                            @error('room_size')
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