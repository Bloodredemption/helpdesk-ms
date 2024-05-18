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
                <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="ticket_no" class="form-label">Ticket Number <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="ticket_no" name="ticket_no" value="{{ $ticket->ticket_no }}" aria-describedby="textHelp" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}" aria-describedby="textHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description <span style="color: red;">*</span></label>
                        <textarea class="form-control" rows="4" cols="50" id="desc" name="desc" aria-describedby="textHelp" required>{{ $ticket->description }}</textarea>
                        <div id="emailHelp" class="form-text"><b>Note:</b> As much as possible, make the description short.</div>
                    </div>
                    <div class="mb-3">
                        <label for="prioritylevel" class="form-label">Priority Level <span style="color: red;">*</span></label>
                        <select class="form-select" id="prioritylevel" name="prioritylevel" aria-describedby="selectHelp" required>
                            <option value="Low" {{ $ticket->prioritylevel === 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Normal" {{ $ticket->prioritylevel === 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Medium" {{ $ticket->prioritylevel === 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="High" {{ $ticket->prioritylevel === 'High' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dept_id" class="form-label">Department <span style="color: red;">*</span></label>
                        <select class="form-select" id="dept_id" name="dept_id" aria-describedby="selectHelp" required>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $ticket->dept_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Assigned User <span style="color: red;">*</span></label>
                        <select class="form-select" id="user_id" name="user_id" aria-describedby="selectHelp" required>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span style="color: red;">*</span></label>
                        <select class="form-select" id="status" name="status" aria-describedby="selectHelp" required>
                            <option value="New" {{ $ticket->status === 'New' ? 'selected' : '' }}>New</option>
                            <option value="In-Progress" {{ $ticket->status === 'In-Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="On-Hold" {{ $ticket->status === 'On-Hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="Resolved" {{ $ticket->status === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                            <option value="Cancelled" {{ $ticket->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var deptSelect = document.getElementById('dept_id');
            var userSelect = document.getElementById('user_id');
            var selectedDepartmentId = deptSelect.value;
            populateUserSelect(selectedDepartmentId, userSelect);
        });
    
        document.getElementById('dept_id').addEventListener('change', function() {
            var selectedDepartmentId = this.value;
            var userSelect = document.getElementById('user_id');
            populateUserSelect(selectedDepartmentId, userSelect);
        });
    
        function populateUserSelect(selectedDepartmentId, userSelect) {
            // userSelect.innerHTML = '<option value="">Select a user</option>';
    
            var tempUserId = "{{ $ticket->temp_user }}"; // Get the current temp_user ID
    
            @foreach ($departments as $department)
                if ({{ $department->id }} === parseInt(selectedDepartmentId)) {
                    @foreach ($department->users as $user)
                        var option = document.createElement('option');
                        option.value = '{{ $user->id }}';
                        option.text = '{{ $user->name }}';
                        if ('{{ $user->id }}' === tempUserId) {
                            option.selected = true; // Select the option if it matches temp_user ID
                            userSelect.insertBefore(option, userSelect.firstChild); // Insert as the first option
                        } else {
                            userSelect.add(option);
                        }
                    @endforeach
                }
            @endforeach
        }
    </script>

@endsection
