@extends('Layout.main')
@section('title', 'Edit Rooms')

@section('middle_content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('rooms') }}"
                class="text-dark">Rooms</a> /</span> Edit Rooms</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Rooms</h5>

                </div>
                <div class="card-body">
                    <form action="{{ route('edit-store-room', ['room_id' => $room->room_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Room Number -->
                        <div class="mb-3">
                            <label class="form-label">Room Number <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-hash"></i></span>
                                <input type="text" class="form-control" name="room_number" placeholder="Enter room number"
                                    value="{{ old('room_number', $room->room_number) }}">
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
                                <!-- <option value="Standard Room" {{ old('room_type') == 'Standard Room' ? 'selected' : '' }}>Standard Room</option>
                                <option value="Deluxe Room" {{ old('room_type') == 'Deluxe Room' ? 'selected' : '' }}>Deluxe Room</option>
                                <option value="Super Deluxe Room" {{ old('room_type') == 'Super Deluxe Room' ? 'selected' : '' }}>Super Deluxe Room</option>
                                <option value="Executive Room" {{ old('room_type') == 'Executive Room' ? 'selected' : '' }}>Executive Room</option>
                                <option value="Suite" {{ old('room_type') == 'Suite' ? 'selected' : '' }}>Suite</option> -->

                                @foreach(config('constants.ROOM_TYPE') as $key => $type)
                                <option value="{{ $key }}" {{ old('room_type', $room->room_type) == $key ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                                @endforeach

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
                                <option value="1" {{ old('ac_no_ac', $room->ac_no_ac) == '1' ? 'selected' : '' }}>AC</option>
                                <option value="0" {{ old('ac_no_ac', $room->ac_no_ac) == '0' ? 'selected' : '' }}>Non-AC</option>
                            </select>
                            @error('ac_no_ac')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Bed capacity -->
                        <div class="mb-3">
                            <label class="form-label">Bed capacity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="bed_capacity" min="1"
                                value="{{ old('bed_capacity', $room->bed_capacity) }}">
                            @error('bed_capacity')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Base Price -->
                        <div class="mb-3">
                            <label class="form-label">Rent <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="rent"
                                value="{{ old('rent', $room->rent) }}">
                            @error('rent')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Old Images</label><br>

                            @php
                            $oldImages = json_decode($room->room_imgs, true) ?? [];
                            @endphp

                            @foreach($oldImages as $img)
                            <div class="d-inline-block text-center me-2">
                                <img src="{{ asset('website-partner/room-imgs/'.$img) }}"
                                    width="80" height="80"
                                    style="object-fit: cover; border:1px solid #ccc; border-radius:5px;">
                                <br>
                                <label>
                                    <input type="checkbox" name="delete_images[]" value="{{ $img }}"> Delete
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Add New Images</label>
                            <input type="file" class="form-control" name="room_imgs[]" multiple>
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