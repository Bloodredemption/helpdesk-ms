<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
          <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)">
            <i class="ti ti-bell-ringing"></i>
            <div class="notification bg-primary rounded-circle"></div>
          </a>
        </li> --}}
        {{-- <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">
            @if(request()->is('dashboard'))
                System / <a href="/dashboard">Dashboard</a>
            @elseif(request()->is('departments'))
                System / <a href="/departments">Departments</a>
            @elseif(request()->is('users'))
                System / <a href="/users">Users</a>
            @elseif(request()->is('tickets'))
                System / <a href="/tickets">tickets</a>
            @elseif(request()->is('transactionlogs'))
                System / <a href="/transactionlogs">Logs</a>
            @else
                System / Default
            @endif
          </span>
        </li> --}}
      </ul>
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
          <div>
            <span><b>{{ auth()->user()->name }}</b></span>
            {{-- <div id="emailHelp" class="form-text">{{ auth()->user()->usertype }}</div> --}}
          </div>
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <div class="message-body">
                {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">My Profile</p>
                </a> --}}
                <a href="{{ route('myaccount', Auth::id()) }}" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">My Account</p>
                </a>
                <!-- <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a> -->
                <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>