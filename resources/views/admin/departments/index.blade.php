@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-title fw-semibold mb-0">Department List</h5>
            
            {{-- <div class="d-inline-flex">
                <div class="dropdown me-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="downloadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-download"></i> Download as
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                        <li><a class="dropdown-item" href="/download-pdf"><i class="ti ti-file-text"></i> PDF</a></li>
                        <li><a class="dropdown-item" href="/download-pdf"><i class="ti ti-file-text"></i> Excel</a></li>
                        <li><a class="dropdown-item" href="/download-pdf"><i class="ti ti-file-text"></i> Word Document</a></li>
                    </ul>
                </div>
                <a href="#" class="btn btn-primary me-2"><i class="ti ti-printer"></i> Print</a>
            </div> --}}
        </div>
        
        {{-- @if(session('success'))
            <div class="alert alert-success mb-2" role="alert">
                {{ session('success') }}
            </div>
        @endif --}}

        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3">
                        <a class="btn btn-primary" href="{{ route('departments.create') }}">Add New Department</a>
                    </div>
                    <div class="col-auto mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0 text-muted">Filter</span>
                            </div>
                            <input type="text" class="form-control form-control-srch" id="userFilter" placeholder="Search ...">
                            <div class="input-group-append">
                                <a href="#" class="btn btn-outline-primary" id="filterButton"><i class="ti ti-search"></i></a>
                            </div>
                            <div class="input-group-append" style="display: none;" id="clearButtonWrapper">
                                <a href="#" class="btn btn-outline-danger" id="clearButton"><i class="ti ti-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mt-2">
                    <table id="example" class="table rounded">
                        <thead class="bg-primary text-white rounded-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="noDataFoundRow" style="display: none">
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>
                            @forelse($departments as $department)
                            <tr>
                                <td>
                                    <a href="{{ route('departments.show', $department->id) }}" class="edit-department">
                                        <b>{{ $department->name }}</b>
                                    </a>
                                </td>
                                <td>
                                    @if($department->status == '1')
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-success rounded-3 fw-semibold">Active</span>
                                        </div>
                                    @elseif($department->status == '0')
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-danger rounded-3 fw-semibold">Inactive</span>
                                        </div>
                                    @endif
                                </td>   
                                <td>{{ $department->created_at->format('F j, Y | h:i A') }}</td>
                                <td>{{ $department->updated_at->format('F j, Y | h:i A') }}</td>
                                <td>
                                    <a href="{{ route('departments.edit', $department->id) }}" class="edit-department">
                                        <i class="ti ti-edit"></i> Edit
                                    </a>
                                    {{-- <form id="delete-form" action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btnedit" onclick="confirmDelete()" style="color: red;" ><i class="ti ti-trash"></i> Remove</button>
                                    </form> --}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No data found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#filterButton').on('click', function() {
                var filterValue = $('#userFilter').val().toLowerCase();
                var rows = $('#example tbody tr');
                var noDataFoundRow = $('#noDataFoundRow');
    
                rows.hide(); // Hide all rows initially
    
                rows.filter(function() {
                    return $(this).text().toLowerCase().indexOf(filterValue) > -1;
                }).show();
    
                if ($('#example tbody tr:visible').length === 0) {
                    noDataFoundRow.show(); // Show "No data found" row if no rows match filter
                } else {
                    noDataFoundRow.hide(); // Hide "No data found" row if there are matching rows
                }
    
                $('#clearButtonWrapper').show(); // Show the clear button wrapper
            });
    
            $('#clearButton').on('click', function() {
                $('#userFilter').val(''); // Clear the filter input
                $('#example tbody tr').show(); // Show all table rows
                $('#noDataFoundRow').hide(); // Hide "No data found" row
                $('#clearButtonWrapper').hide(); // Hide the clear button wrapper
            });
    
            // Show or hide clear button based on filter input value
            $('#userFilter').on('input', function() {
                var filterValue = $(this).val();
                if (filterValue.trim() !== '') {
                    $('#clearButtonWrapper').show();
                } else {
                    $('#clearButtonWrapper').hide();
                }
            });
        });
    </script>
    <script>
        function confirmDelete() {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5D87FF',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
    @if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
    @endif
@endsection
