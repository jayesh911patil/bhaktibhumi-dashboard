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
                        <form action="{{ route('add-store-dharamshala') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- dharamshala_id -->
                            <div class="mb-3">
                                <label class="form-label" for="add-store-dharamshala">Dharamshala Id</label>
                                <div class="input-group input-group-merge">
                                    
                                    <input type="text" class="form-control" id="dharamshala_id" name="dharamshala_id"
                                         aria-label="dharamshala_id"
                                        aria-describedby="dharamshala-title-icon" value="{{ old('dharamshala_id') }}" />
                                </div>
                                @error('dharamshala_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="add-store-dharamshala">Your Name </label>
                                <div class="input-group input-group-merge">
                                    
                                    <input type="text" class="form-control" id="name" name="name"
                                         aria-label="name"
                                        aria-describedby="dharamshala-title-icon" value="{{ old('name') }}" />
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="add-store-dharamshala">Dharamshala Name </label>
                                <div class="input-group input-group-merge">
                                    
                                    <input type="text" class="form-control" id="dharamshala_name" name="dharamshala_name"
                                         aria-label="dharamshala_name"
                                        aria-describedby="dharamshala-title-icon" value="{{ old('dharamshala_name') }}" />
                                </div>
                                @error('dharamshala_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="add-store-dharamshala">Your Phone </label>
                                <div class="input-group input-group-merge">
                                    
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                         aria-label="phone_number"
                                        aria-describedby="dharamshala-title-icon" value="{{ old('phone_number') }}" />
                                </div>
                                @error('dharamshala_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="add-store-dharamshala">Your Email </label>
                                <div class="input-group input-group-merge">
                                    
                                    <input type="email" class="form-control" id="email" name="email"
                                         aria-label="email"
                                        aria-describedby="dharamshala-title-icon" value="{{ old('email') }}" />
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>





                            <!-- address -->
                            <div class="mb-3">
                                <label class="form-label" for="address">Address </label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <textarea class="form-control" id="address" name="address"
                                        placeholder="Add short description" rows="2">{{ old('address') }}</textarea>
                                    <span class="input-group-text">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- address -->
                            <div class="mb-3">
                                <label class="form-label" for="dharamshala_address">Dharamshala Address  </label>
                                <div class="input-group input-group-merge speech-to-text">
                                    <textarea class="form-control" id="dharamshala_address" name="dharamshala_address"
                                        placeholder="Add short description" rows="2">{{ old('dharamshala_address') }}</textarea>
                                    <span class="input-group-text">
                                        <i class="bx bx-microphone cursor-pointer text-to-speech-toggle"></i>
                                    </span>
                                </div>
                                @error('dharamshala_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Authorize Signature -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Authorize Signature</label>
                                <div class="input-group input-group-merge">
                                    
                                    <input class="form-control" name="auth_sign" id="auth_sign" type="file" id="formFile" />
                                </div>
                                @error('auth_sign')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                             <!-- Authorize Photo  -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Authorize Photo </label>
                                <div class="input-group input-group-merge">
                                    
                                    <input class="form-control" name="auth_img" id="auth_img" type="file" id="formFile" />
                                </div>
                                @error('auth_img')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="add-store-dharamshala">Authorize Aadhar Number </label>
                                <div class="input-group input-group-merge">
                                    
                                    <input type="tel" class="form-control" id="auth_aadhar" name="auth_aadhar"
                                         aria-label="auth_aadhar"
                                        aria-describedby="dharamshala-title-icon" value="{{ old('auth_aadhar') }}"  required maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12);"/>
                                </div>
                                @error('auth_aadhar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btns">
                                <i class="bx bx-send"></i> Submit
                            </button>

                            <button type="button" class="btn btn-secondary">
                                <a class="text-white" href="{{ route('dharamshala') }}"> <i class="bx bx-x"></i> Cancel</a>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection