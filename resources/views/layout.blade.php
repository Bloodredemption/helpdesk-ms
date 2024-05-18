<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    @if(str_starts_with(request()->path(), 'dashboard'))
    Dashboard
    @elseif(str_starts_with(request()->path(), 'udashboard'))
    User Dashboard
    @elseif(str_starts_with(request()->path(), 'departments'))
    Departments
    @elseif(str_starts_with(request()->path(), 'users'))
    Users
    @elseif(str_starts_with(request()->path(), 'tickets'))
    My Tickets
    @elseif(str_starts_with(request()->path(), 'logs'))
    Logs
    @elseif(str_starts_with(request()->path(), 'assignedtickets'))
    Assigned Tickets
    @else
    Helpdesk Management System
    @endif
  </title>
  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert@2"></script> --}}
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <style>
    .table thead th:first-child {
      border-top-left-radius: 1rem;
    }
  
    .table thead th:last-child {
      border-top-right-radius: 1rem;
    }

    /* Custom CSS for pagination icons */
    .pagination .page-link {
        font-size: 0.875rem; /* Set the font size smaller */
    }

    .pagination .page-item:not(:last-child) .page-link {
        margin-right: 0.5rem; /* Add some spacing between pagination links */
    }

    .btnedit{
      display: inline-block;
      font-weight: 400;
      color: #1F1F1F;
      text-align: center;
      vertical-align: middle;
      user-select: none;
      background-color: transparent;
      border: 1px solid transparent;
      font-size: 0.875rem;
      line-height: 1;k 
      border-radius: 0.1875rem;
      transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('partials.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('partials.header')
      <!--  Header End -->
      @yield('container-fluid')
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script> --}}
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
</body>

</html>