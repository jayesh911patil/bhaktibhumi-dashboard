@extends('Layout.main')
@section('title', 'Add Dharamshala')
@section('middle_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('dharamshala') }}"
                    class="text-dark">Dharamshala</a> /</span> Add Dharamshala</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Add Dharamshala</h5>

                    </div>
                    <div class="card-body">

<form action="#" method="POST">
    @csrf

    {{-- Room Category Name --}}
    <div class="mb-3">
        <label class="form-label" for="room_cat_name">Category Name</label>
        <div class="input-group input-group-merge">
            <span id="room-cat-name-icon" class="input-group-text">
                <i class="bx bx-bookmark"></i>
            </span>
            <input type="text" class="form-control" id="room_cat_name" name="room_cat_name"
                placeholder="e.g., Deluxe, Super Deluxe" aria-label="Room Category Name"
                value="{{ old('room_cat_name') }}" />
        </div>
        @error('room_cat_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Room Category Description --}}
    <div class="mb-3">
        <label class="form-label" for="room_cat_desc">Description</label>
        <div class="input-group input-group-merge">
            <span id="room-cat-desc-icon" class="input-group-text">
                <i class="bx bx-detail"></i>
            </span>
            <textarea class="form-control" id="room_cat_desc" name="room_cat_desc" rows="2"
                placeholder="Short description about this category">{{ old('room_cat_desc') }}</textarea>
        </div>
        @error('room_cat_desc')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Status --}}
    <div class="mb-3">
        <label class="form-label" for="status">Status</label>
        <div class="input-group input-group-merge">
            <span id="status-icon" class="input-group-text">
                <i class="bx bx-check-circle"></i>
            </span>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Not Active</option>
            </select>
        </div>
        @error('status')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="text-end">
        <button type="submit" class="btn btn-primary">
            <i class="bx bx-save"></i> Save Category
        </button>
    </div>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
