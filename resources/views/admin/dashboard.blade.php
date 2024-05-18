@extends('layout')

@section('container-fluid')
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                  <!-- Total Departments -->
                  <div class="card">
                    <div class="card-body">
                      <div class="row alig n-items-start">
                        <div class="col-8">
                          <h5 class="card-title mb-9 fw-semibold">Total Number of Departments</h5>
                          <h4 class="fw-semibold mb-3">{{ $totalDepartments }}</h4>
                        </div>
                        <div class="col-4">
                          <div class="d-flex justify-content-end">
                            <div
                              class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                              <i class="ti ti-link fs-6"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                  <!-- Total Users -->
                  <div class="card">
                    <div class="card-body">
                      <div class="row alig n-items-start">
                        <div class="col-8">
                          <h5 class="card-title mb-9 fw-semibold">Total Number of Users</h5>
                          <h4 class="fw-semibold mb-3">{{ $totalUsers }}</h4>
                        </div>
                        <div class="col-4">
                          <div class="d-flex justify-content-end">
                            <div
                              class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                              <i class="ti ti-users fs-6"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>

          <div class="col-lg-12 d-flex align-items-strech">
              <div class="card w-100">
                  <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Recent Tickets</h5>
                    <div class="table-responsive">
                      <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0">Ticket No.</h6>
                                </th>
                                <th class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0">Ticket Details</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Assigned by</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Assigned to</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignedTickets as $assignedTicket)
                            <tr>
                                <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0 fs-4"><b>{{ $assignedTicket->ticket->ticket_no }}</b></h6>
                                </td>
                                <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-1">{{ $assignedTicket->ticket->title }}</h6>
                                  <span class="fw-normal">{{ $assignedTicket->ticket->description }}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $assignedTicket->assignedBy->name }}</h6>
                                    <span class="fw-normal">{{ $assignedTicket->assignedBy->position }}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $assignedTicket->assignedTo->name }}</h6>
                                    <span class="fw-normal">{{ $assignedTicket->assignedTo->position }}</span>
                                </td>
                                <td class="border-bottom-0">
                                  <div class="d-flex align-items-center gap-2">
                                      @switch($assignedTicket->ticket->status)
                                          @case('Resolved')
                                              <span class="badge bg-success rounded-3 fw-semibold">Resolved</span>
                                              @break
                                          @case('Pending')
                                              <span class="badge bg-warning rounded-3 fw-semibold">Pending</span>
                                              @break
                                          @case('New')
                                              <span class="badge bg-primary rounded-3 fw-semibold">New</span>
                                              @break
                                          @case('Cancelled')
                                              <span class="badge bg-danger rounded-3 fw-semibold">Canceled</span>
                                              @break
                                          @case('In-Progress')
                                              <span class="badge bg-secondary rounded-3 fw-semibold">In Progress</span>
                                              @break
                                          @case('On-Hold')
                                              <span class="badge bg-warning rounded-3 fw-semibold">On Hold</span>
                                              @break
                                      @endswitch
                                  </div>
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
            
        </div>
    </div>
@endsection