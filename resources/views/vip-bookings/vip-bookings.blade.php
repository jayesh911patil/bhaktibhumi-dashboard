@extends('Layout.main')
@section('title', 'Vip Booking')
@section('middle_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('dashboard') }}"
                    class="text-dark">Dashboard</a> /</span> Vip Booking</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row align-items-center py-2 px-3">
                <div class="col-md-6">
                    <h5 class="mb-0 head">Vip Booking</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('add-vip-bookings') }}" class="btn btns text-white">
                        <b>Add Vip Booking</b>
                    </a>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table class="yajra-datatables table table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
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
                ajax: '{{ route('vip-bookings') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
                    { data: 'title', name: 'title', orderable: false },
                    { data: 'description', name: 'description', orderable: false },
                    { data: 'image', name: 'image', orderable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: true }
                ]
            });

            // Handle View Description button click
            $(document).on('click', '.view-description', function () {
                var description = $(this).data('description');
                $('#modal-description-content').text(description);
            });
        });
    </script>
@endpush