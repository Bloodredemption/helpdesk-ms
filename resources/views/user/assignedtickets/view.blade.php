@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="card-title fw-semibold mb-2">
            <span style="display: inline-block; vertical-align: middle;">View Ticket</span>
            <a href="/assignedtickets" style="display: inline-block; vertical-align: middle;">&#8592; <span>Back</span></a>
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
                    <strong>Assigned To:</strong>
                    {{ $ticket->temporaryUser->name }}
                </div>
                
                <div class="col-xs-12 col-sm-12">
                    <strong>Date Issued:</strong>
                    {{ $ticket->created_at->format('F j, Y | h:i A') }}
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Date Solved:</strong>
                    @if ($ticket->date_solved)
                        {{ \Carbon\Carbon::parse($ticket->date_solved)->format('F j, Y | h:i A') }}
                    @else
                        (Null)
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12">
                    <strong>Date Updated:</strong>
                    {{ $ticket->updated_at->format('F j, Y | h:i A') }}
                </div>
                {{-- <div class="col-xs-12 col-sm-12">
                    <strong>Date Updated:</strong>
                    {{ $ticket->created_at->format('F j, Y | h:i A') }}
                </div> --}}
                <div class="col-xs-12 col-sm-12">
                    <strong>Status:</strong>
                    @if($ticket->status == 'Resolved')
                        <span class="badge bg-success rounded-3 fw-semibold">Resolved</span>
                    @elseif($ticket->status == 'Pending')
                        <span class="badge bg-warning rounded-3 fw-semibold">Pending</span>
                    @elseif($ticket->status == 'New')
                        <span class="badge bg-primary rounded-3 fw-semibold">New</span>
                    @elseif($ticket->status == 'Cancelled')
                        <span class="badge bg-danger rounded-3 fw-semibold">Canceled</span>
                    @elseif($ticket->status == 'In-Progress')
                        <span class="badge bg-secondary rounded-3 fw-semibold">In Progress</span>
                    @elseif($ticket->status == 'On-Hold')
                        <span class="badge bg-warning rounded-3 fw-semibold">On Hold</span>
                    @endif
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
