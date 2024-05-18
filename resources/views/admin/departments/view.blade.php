@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">View Department</span>
            <a href="/departments" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a>
        </div>
        
        <h6 class="font-weight-normal mb-0">Department Information.</h6>
        <br>
        
        <div class="card">
            <div class="card-body">
                <div class="col-xs-12 col-sm-12">
                    <strong>Name:</strong>
                    {{ $department->name }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Date Created:</strong>
                    {{ $department->created_at->format('F j, Y | h:i A') }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Date Updated:</strong>
                    {{ $department->updated_at->format('F j, Y | h:i A') }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Status:</strong>
                    @if($department->status == '1')
                        <div class="badge bg-success rounded-3 fw-semibold">Active</div>
                    @elseif($department->status == '0')
                        <div class="badge badge-danger">Inactive</div>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12 mt-3">
                    <form id="delete-form" action="{{ route('departments.destroy',$department->id) }}" method="POST">
                        <a class="btnedit" style="color: blue;" href="{{ route('departments.edit',$department->id) }}" title="Edit">
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
