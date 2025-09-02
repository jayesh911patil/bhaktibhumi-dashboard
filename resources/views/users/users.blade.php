@extends('Layout.main')
@section('title', 'Users')
@section('middle_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('dashboard') }}"
                    class="text-dark">Dashboard</a> /</span> Users</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row align-items-center py-2 px-3">
                <div class="col-md-6">
                    <h5 class="mb-0 head">Users</h5>
                </div>

            </div>
            <div class="table-responsive text-nowrap p-3">
                <table class="yajra-datatables table table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>User Name</th>
                            <th>Gender</th>
                            <th>Date Of Birth</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

    <!-- Description Modal -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-description-content">
                    <!-- Description text will be inserted here -->
                </div>
            </div>
        </div>
    </div>







@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('.yajra-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
                    { data: 'full_name', name: 'full_name', orderable: false },
                    { data: 'gender', name: 'gender', orderable: false },
                    { data: 'date_of_birth', name: 'date_of_birth', orderable: false },
                    { data: 'phone_number', name: 'phone_number', orderable: false },
                    { data: 'address', name: 'address', orderable: false }
                ]
            });
        });
    </script>
@endpush