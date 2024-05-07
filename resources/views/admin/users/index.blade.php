@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <h5 class="card-title fw-semibold mb-2">User List</h5>
        
        @if(session('success'))
            <div class="alert alert-success mb-2" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">Add New User</button>
                <div class="table-responsive mt-4">
                    <table class="table rounded">
                        <thead class="bg-primary text-white rounded-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Sex</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>{{ $user->sex }}</td>
                                <td>{{ $user->usertype }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <a href="#" class="edit-department" data-bs-toggle="modal" data-bs-target="#editDepartmentModal" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-sex="{{ $user->sex }}" data-user-email="{{ $user->email }}" data-user-type="{{ $user->usertype }}" data-user-password="{{ $user->password }}">
                                        <i class="ti ti-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No data found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Department Modal -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="textHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select" id="sex" name="sex" aria-describedby="selectHelp" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userType" class="form-label">User Type</label>
                            <select class="form-select" id="userType" name="userType" aria-describedby="selectHelp" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userDept" class="form-label">Department</label>
                            <select class="form-select" id="userDept" name="userDept" aria-describedby="selectHelp" required>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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
                    <h5 class="modal-title" id="editDepartmentModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editDepartmentForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control" id="user_id" name="user_id" hidden>

                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" required>
                        </div>
                        <div class="mb-3">
                            <label for="userSex" class="form-label">Sex</label>
                            <select class="form-select" id="userSex" name="userSex" aria-describedby="selectHelp" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userType" class="form-label">User Type</label>
                            <select class="form-select" id="userType" name="usertype" aria-describedby="selectHelp" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-4">
                            <label for="userPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userPassword" name="userPassword" required>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var userID; // Define deptID as a global variable
        $(document).ready(function () {
            $('.edit-department').on('click', function () {
                var userId = $(this).data('user-id');
                var userName = $(this).data('user-name');
                var userSex = $(this).data('user-sex');
                var userEmail = $(this).data('user-email');
                var userType = $(this).data('user-type');
                var userPass = $(this).data('user-password');
                // console.log(userId);

                // Assign value to the global variable userId
                window.userId = userId;
                
                $('#userName').val(userName);
                $('#userSex').val(userSex);
                $('#userEmail').val(userEmail);
                $('#usertype').val(userType);
                $('#user_id').val(userId);
                $('#userPassword').val(userPass);
            });


            $('#editDepartmentForm').submit(function(e) {
                e.preventDefault();
                
                var formData = $(this).serialize();
                console.log(formData);

                $.ajax({
                    url: "/updateusers",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Show SweetAlert notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message, // Assuming the response contains a message key
                            showConfirmButton: false,
                            timer: 1500 // Display the notification for 1.5 seconds
                        }).then(() => {
                            // Reload the page
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    
@endsection
