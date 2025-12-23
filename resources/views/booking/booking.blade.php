@extends('Layout.main')
@section('title', 'Bookings')
@section('middle_content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('dashboard') }}"
                class="text-dark">Dashboard</a> /</span> Bookings</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="row align-items-center py-2 px-3">
            <div class="col-md-6">
                <h5 class="mb-0 head"> Bookings</h5>
            </div>
            <div class="col-md-6 text-end">

            </div>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="yajra-datatables table table-striped">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Room Type</th>
                        <th>Arrive From</th>
                        <th>Arrive To</th>
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
    $(function() {
    $('.yajra-datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('booking') }}",
        columns: [
            { data: 'customer_name', name: 'name' },
            { data: 'room_type', name: 'room.room_type', orderable: false },
            { data: 'arrive_from', name: 'check_in' },
            { data: 'arrive_to', name: 'check_out' }
        ]
    });
});

</script>
@endpush