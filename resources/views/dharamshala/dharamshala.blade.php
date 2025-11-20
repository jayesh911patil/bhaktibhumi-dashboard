@extends('Layout.main')
@section('title', 'Dharamshala')
@section('middle_content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('dashboard') }}"
                    class="text-dark">Dashboard</a> /</span> Dharamshala</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row align-items-center py-2 px-3">
                <div class="col-md-6">
                    <h5 class="mb-0 head">Dharamshala</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('add-dharamshala') }}" class="btn btns text-white">
                        <b>Add Dharamshala</b>
                    </a>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table class="yajra-datatables table table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Dharamshala Name</th>
                            <th>Dharamshala Address</th>
                            <th>Image</th>
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
                ajax: '{{ route('dharamshala.data') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
                    { data: 'dharamshala_name', name: 'dharamshala_name', orderable: false },
                    { data: 'dharamshala_address', name: 'dharamshala_address', orderable: false },
                    { data: 'dharmashala_image', name: 'dharmashala_image', orderable: false }
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