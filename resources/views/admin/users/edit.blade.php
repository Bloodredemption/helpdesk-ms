@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">Add New User</span>
            <a href="/users" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a>
        </div>
        
        <h6 class="font-weight-normal mb-0">Fill all the required fields. <span style="color: red;">*</span></h6>
        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" aria-describedby="textHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="sex" class="form-label">Sex <span style="color: red;">*</span></label>
                        <select class="form-select" id="sex" name="sex" aria-describedby="selectHelp" required>
                            <option value="Male" {{ $user->sex === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user->sex === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userType" class="form-label">User Type <span style="color: red;">*</span></label>
                        <select class="form-select" id="userType" name="userType" aria-describedby="selectHelp" required>
                            <option value="User" {{ $user->usertype == 'User' ? 'selected' : '' }}>User</option>
                            <option value="Admin" {{ $user->usertype == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    @if($user->usertype == 'User')
                        <div class="mb-3" id="deptDiv">
                            <label for="dept" class="form-label">Department <span style="color: red;">*</span></label>
                            <select class="form-select" id="dept" name="dept" aria-describedby="selectHelp" required>
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @foreach ($otherDepartments as $otherDepartment)
                                    <option value="{{ $otherDepartment->id }}">{{ $otherDepartment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="positionDiv">
                            <label for="position" class="form-label">Position <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="position" value="{{ $user->position }}" name="position" aria-describedby="textHelp">
                        </div>
                    @elseif($user->usertype === 'Admin')
                        <div class="mb-3" id="deptDiv">
                            <label for="dept" class="form-label">Department <span style="color: red;">*</span></label>
                            <select class="form-select" id="dept" name="dept" aria-describedby="selectHelp" required>
                                @foreach ($otherDepartments as $otherDepartment)
                                    <option value="{{ $otherDepartment->id }}">{{ $otherDepartment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="positionDiv">
                            <label for="position" class="form-label">Position <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="position" name="position" aria-describedby="textHelp">
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" aria-describedby="emailHelp" required>
                        {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </form>
            </div>
        </div>

        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">Change Password</span>
            {{-- <a href="/users" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a> --}}
        </div>
        
        <h6 class="font-weight-normal mb-0">Fill all the required fields. <span style="color: red;">*</span></h6>
        <br>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.updatePass', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="password" class="form-label">New Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var userTypeSelect = document.getElementById('userType');
            var deptDiv = document.getElementById('deptDiv');
            var posDiv = document.getElementById('positionDiv');
    
            function toggleFields() {
                if (userTypeSelect.value === 'Admin') {
                    deptDiv.style.display = 'none';
                    posDiv.style.display = 'none';
                } else {
                    deptDiv.style.display = 'block';
                    posDiv.style.display = 'block';
                }
            }
    
            // Initial call to set the correct display
            toggleFields();
    
            // Add event listener to toggle display on change
            userTypeSelect.addEventListener('change', toggleFields);
        });
    </script>
@endsection
