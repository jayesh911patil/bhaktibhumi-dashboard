@extends('Layout.main')
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
                        <form>
                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label" for="dharamshala-title">Title</label>
                                <div class="input-group input-group-merge">
                                    <span id="dharamshala-title-icon" class="input-group-text">
                                        <i class="bx bx-building-house"></i> <!-- Suggests a place/building -->
                                    </span>
                                    <input type="text" class="form-control" id="dharamshala-title"
                                        placeholder="e.g., Shree Ram Dharamshala" aria-label="Title"
                                        aria-describedby="dharamshala-title-icon" />
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label" for="dharamshala-description">Description</label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <textarea class="form-control" placeholder="Add short description" rows="2"></textarea>
                                    <span class="input-group-text">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bx bx-image-add"></i> <!-- Suggests image upload -->
                                    </span>
                                    <input class="form-control" type="file" id="formFile" />
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-warning">
                                <i class="bx bx-send"></i> Send
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection