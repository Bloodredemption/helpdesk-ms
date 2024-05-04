@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <h5 class="card-title fw-semibold mb-2">Department List</h5>
        
        @if(session('success'))
            <div class="alert alert-success mb-2" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">Add New Department</button>
                <div class="table-responsive mt-4">
                    <table class="table  rounded">
                        <thead class="bg-primary text-white rounded-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->created_at }}</td>
                                <td>{{ $department->updated_at }}</td>
                                <td>
                                    <a href="#" class="edit-department" data-bs-toggle="modal" data-bs-target="#editDepartmentModal" data-department-id="{{ $department->id }}" data-department-name="{{ $department->name }}">
                                        <i class="ti ti-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No data found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $departments->links() }}
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Add Department Modal -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="departmentName" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="departmentName" name="departmentName" required>
                        </div>
                        <!-- Add more input fields if needed -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Department Modal -->
    <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editDepartmentForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editDepartmentName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="departmentNameInput" name="departmentName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var deptID; // Define deptID as a global variable
        $(document).ready(function () {
            $('.edit-department').on('click', function () {
                var departmentId = $(this).data('department-id');
                var departmentName = $(this).data('department-name');
                deptID = departmentId; // Assign value to the global variable deptID
                $('#departmentNameInput').val(departmentName);
                // Fetch department name based on ID via AJAX
                // $.ajax({
                //     url: '/departments/' + departmentId,
                //     type: 'GET',
                //     success: function (response) {
                //         $('#departmentNameInput').val(response.name);
                //     },
                //     error: function (xhr, status, error) {
                //         console.log(departmentId);
                //         console.error(xhr.responseText);
                //         alert('Error: Department not found');
                //     }
                // });
            });
        });
    </script>     --}}
    
@endsection
