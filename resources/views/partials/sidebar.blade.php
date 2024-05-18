<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="/dashboard" class="text-nowrap logo-img">
          <img src="{{ asset('assets/images/logos/dark-logo.png') }}" width="180" alt="">
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">          
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
          </li>
          @if(auth()->user()->usertype === 'Admin')
          <li class="sidebar-item">
            <a class="sidebar-link {{ (str_starts_with(request()->path(), 'dashboard')) ? 'active' : '' }}" href="/dashboard" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ (str_starts_with(request()->path(), 'departments')) ? 'active' : '' }}" href="/departments" aria-expanded="false">
              <span>
                <i class="ti ti-link"></i>
              </span>
              <span class="hide-menu">Departments</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ (str_starts_with(request()->path(), 'users')) ? 'active' : '' }}" href="/users" aria-expanded="false">
              <span>
                <i class="ti ti-users"></i>
              </span>
              <span class="hide-menu">Users</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ (str_starts_with(request()->path(), 'logs')) ? 'active' : '' }}" href="/logs" aria-expanded="false">
              <span>
                <i class="ti ti-file-info"></i>
              </span>
              <span class="hide-menu">Logs</span>
            </a>
          </li>
          @elseif(auth()->user()->usertype === 'User')
          <li class="sidebar-item">
            <a class="sidebar-link {{ (str_starts_with(request()->path(), 'tickets')) ? 'active' : '' }}" href="/tickets" aria-expanded="false">
              <span>
                <i class="ti ti-ticket"></i>
              </span>
              <span class="hide-menu">My Tickets</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link {{ (str_starts_with(request()->path(), 'assignedtickets')) ? 'active' : '' }}" href="/assignedtickets" aria-expanded="false">
              <span>
                <i class="ti ti-ticket"></i>
              </span>
              <span class="hide-menu">Assigned Tickets</span>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>