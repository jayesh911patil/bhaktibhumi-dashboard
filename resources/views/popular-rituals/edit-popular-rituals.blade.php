@extends('Layout.main')
@section('middle_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('popular-rituals') }}"
                    class="text-dark">Popular Rituals</a> /</span> Edit Popular Rituals</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Popular Rituals</h5>

                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('edit-store-popular-rituals', ['popular_rituals_id' => $popularritual->popular_rituals_id])}}"
                            method="POST" enctype="multipart/form-data">
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
                                        aria-describedby="dharamshala-title-icon" value="{{ $popularritual->title }}" />
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
                                        placeholder="Add short description"
                                        rows="2">{{ $popularritual->description }}</textarea>
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
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*">

                                {{-- Hidden field to hold current image name --}}
                                <input type="hidden" name="hidden_image" value="{{ $popularritual->image }}">

                                @if (!empty($popularritual->image))
                                    <div class="mt-2">
                                        <img src="{{ asset($popularritual->image) }}" alt="Image"
                                            style="max-width: 120px; border-radius: 10px; border: 1px solid #ccc;">
                                    </div>
                                @endif

                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btns">
                                <i class="bx bx-send"></i> Submit
                            </button>

                            <button type="button" class="btn btn-secondary">
                                <a class="text-white" href="{{ route('popular-rituals') }}"> <i class="bx bx-x"></i> Cancel</a>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection