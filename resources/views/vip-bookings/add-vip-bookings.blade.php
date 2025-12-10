@extends('Layout.main')
@section('title', 'Add Vip Booking')

@section('middle_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('popular-rituals') }}"
                    class="text-dark">Vip Booking</a> /</span> Add Vip Booking</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Add Vip Booking</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('add-store-vip-bookings') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label" for="add-store-dharamshala">Title</label>
                                <div class="input-group input-group-merge">
                                    <span id="add-store-dharamshala" class="input-group-text">
                                        <i class="bx bx-building-house"></i> <!-- Suggests a place/building -->
                                    </span>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="e.g., Shree Ram Dharamshala" aria-label="Title"
                                        aria-describedby="dharamshala-title-icon" value="{{ old('title') }}" />
                                </div>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <textarea class="form-control" id="description" name="description"
                                        placeholder="Add short description" rows="2">{{ old('description') }}</textarea>
                                    <span class="input-group-text">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bx bx-image-add"></i> <!-- Suggests image upload -->
                                    </span>
                                    <input class="form-control" name="image" id="image" type="file" id="formFile" />
                                </div>
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btns">
                                <i class="bx bx-send"></i> Submit
                            </button>

                            <button type="button" class="btn btn-secondary">
                                <a class="text-white" href="{{ route('vip-bookings') }}"> <i class="bx bx-x"></i> Cancel</a>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection