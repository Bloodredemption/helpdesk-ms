@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">View Ticket</span>
            <a href="/tickets" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a>
        </div>
        
        <h6 class="font-weight-normal mb-0">Ticket Information.</h6>
        <br>
        
        <div class="card">
            <div class="card-body">
                <div class="col-xs-12 col-sm-12">
                    <strong>Ticket No:</strong>
                    {{ $ticket->ticket_no }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Title:</strong>
                    {{ $ticket->title }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Description:</strong>
                    {{ $ticket->description }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Priority Level:</strong>
                    {{ $ticket->prioritylevel }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Issued by:</strong>
                    {{ $ticket->assignedUser->name }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Assigned To:</strong>
                    {{ $ticket->temporaryUser->name }}
                </div>
                
                <div class="col-xs-12 col-sm-12">
                    <strong>Date Issued:</strong>
                    {{ $ticket->created_at->format('F j, Y | h:i A') }}
                </div>
                {{-- <div class="col-xs-12 col-sm-12">
                    <strong>Date Updated:</strong>
                    {{ $ticket->created_at->format('F j, Y | h:i A') }}
                </div> --}}
                <div class="col-xs-12 col-sm-12">
                    <strong>Status:</strong>
                    @if($ticket->status == 'Solved')
                        <div class="badge bg-success rounded-3 fw-semibold">Active</div>
                    @elseif($ticket->status == 'Pending')
                        <div class="badge bg-warning rounded-3 fw-semibold">Pending</div>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12 mt-3">
                    <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">
                        <a class="btnedit" style="color: blue;" href="{{ route('tickets.edit',$ticket->id) }}" title="Edit">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btnedit" style="color: red;"><i class="ti ti-trash"></i> Remove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
