@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">View User</span>
            <a href="/users" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a>
        </div>
        
        <h6 class="font-weight-normal mb-0">User Information.</h6>
        <br>
        
        <div class="card">
            <div class="card-body">
                <div class="col-xs-12 col-sm-12">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>User Type:</strong>
                    {{ $user->usertype }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
                @if($user->usertype == 'User')
                    <div class="col-xs-12 col-sm-12">
                        <strong>Department:</strong>
                        {{ $department->name }}
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <strong>Position:</strong>
                        {{ $user->position }}
                    </div>
                @endif
                <div class="col-xs-12 col-sm-12">
                    <strong>Date Created:</strong>
                    {{ $user->created_at->format('F j, Y | h:i A') }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Status:</strong>
                    @if($user->status == '1')
                        <div class="badge bg-success rounded-3 fw-semibold">Active</div>
                    @elseif($user->status == '0')
                        <div class="badge badge-danger">Inactive</div>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12 mt-3">
                    <form id="delete-form" action="{{ route('users.destroy',$user->id) }}" method="POST">
                        <a class="btnedit" style="color: blue;" href="{{ route('users.edit',$user->id) }}" title="Edit">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btnedit" onclick="confirmDelete()" style="color: red;"><i class="ti ti-trash"></i> Remove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

@endsection
