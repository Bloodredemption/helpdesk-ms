@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <h5 class="card-title fw-semibold mb-2">Ticket List</h5>
        
        @if(session('success'))
            <div class="alert alert-success mb-2" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">Add New Ticket</button>
                <div class="table-responsive mt-4">
                    <table class="table rounded">
                        <thead class="bg-primary text-white rounded-top">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Priority Level</th>
                                <th scope="col">Date Issued</th>
                                <th scope="col">Issued by</th>
                                <th scope="col">Assigned to</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">No data found.</td>
                            </tr>
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
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add New Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="textHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <input type="text" class="form-control" id="desc" name="desc" aria-describedby="textHelp" required>
                            <div id="emailHelp" class="form-text">Describe what you want to do.</div>
                        </div>
                        <div class="mb-3">
                            <label for="priorityLevel" class="form-label">Priority Level</label>
                            <select class="form-select" id="priorityLevel" name="priorityLevel" aria-describedby="selectHelp" required>
                                <option value="1">Normal</option>
                                <option value="2">Mid</option>
                                <option value="3">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="priorityLevel" class="form-label">Assign User</label>
                            <select class="form-select" id="priorityLevel" name="priorityLevel" aria-describedby="selectHelp" required>
                                <option value="male">User 1</option>
                                <option value="female">User 2</option>
                                <option value="other">User 3</option>
                            </select>
                        </div>
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
    <!-- <script>
        var userID; // Define deptID as a global variable
        $(document).ready(function () {
            $('.edit-department').on('click', function () {
            var userId = $(this).data('user-id');
            var userName = $(this).data('user-name');
            var userSex = $(this).data('user-sex');
            var userEmail = $(this).data('user-email');
            var userType = $(this).data('user-type');
            userId = userID; // Assign value to the global variable userId
            $('#userName').val(userName);
            $('#userSex').val(userSex);
            $('#userEmail').val(userEmail);
            $('#usertype').val(userType);
            $('#user_id').val(userId);
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
    </script> -->
    
@endsection
