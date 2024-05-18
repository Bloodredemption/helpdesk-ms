@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">Edit Department</span>
            <a href="/departments" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a>
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
                <form action="{{ route('departments.update',$department->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="departmentName" class="form-label">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{ $department->name }}" id="departmentName" name="departmentName" aria-describedby="textHelp" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
