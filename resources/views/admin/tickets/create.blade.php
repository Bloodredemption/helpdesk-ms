@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">Add New Ticket</span>
            <a href="/tickets" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a>
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
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="textHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description <span style="color: red;">*</span></label>
                        <textarea class="form-control" rows="4" cols="50" id="desc" name="desc" aria-describedby="textHelp"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="prioritylevel" class="form-label">Priority Level <span style="color: red;">*</span></label>
                        <select class="form-select" id="prioritylevel" name="prioritylevel" aria-describedby="selectHelp" required>
                            <option value="Low">Low</option>
                            <option value="Normal">Normal</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dept_id" class="form-label">Department <span style="color: red;">*</span></label>
                        <select class="form-select" id="dept_id" name="dept_id" aria-describedby="selectHelp" required>
                            <option value="">Select a department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Assign User <span style="color: red;">*</span></label>
                        <select class="form-select" id="user_id" name="user_id" aria-describedby="selectHelp" required>
                            <option value="">Select a user</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('dept_id').addEventListener('change', function() {
            var selectedDepartmentId = this.value;
            var userSelect = document.getElementById('user_id');
            userSelect.innerHTML = '<option value="">Select a user</option>';
    
            @foreach ($departments as $department)
                if ({{ $department->id }} === parseInt(selectedDepartmentId)) {
                    @foreach ($department->users as $user)
                        var option = document.createElement('option');
                        option.value = '{{ $user->id }}';
                        option.text = '{{ $user->name }}';
                        userSelect.add(option);
                    @endforeach
                }
            @endforeach
        });
    </script>
    
@endsection
