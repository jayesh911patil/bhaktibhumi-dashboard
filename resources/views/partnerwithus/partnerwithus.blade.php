@extends('Layout.main')
@section('title', 'Partner With Us')

@section('middle_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('dashboard') }}"
                    class="text-dark">Dashboard</a> /</span> Partner With Us</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row align-items-center py-2 px-3">
                <div class="col-md-6">
                    <h5 class="mb-0 head">Partner With Us</h5>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table class="yajra-datatables table table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Dharamshala</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
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
                ajax: '{{ route('partner-with-us') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
                    { data: 'name', name: 'name', orderable: false },
                    { data: 'email', name: 'email', orderable: false },
                    { data: 'phone_number', name: 'phone_number', orderable: false },
                    { data: 'dharamshala_name', name: 'dharamshala_name', orderable: false },
                    { data: 'address', name: 'address', orderable: false },
                    { data: 'admin_status', name: 'admin_status', orderable: false },
                    { data: 'action', name: 'action', orderable: false }
                ]
            });
        });
    </script>
@endpush
