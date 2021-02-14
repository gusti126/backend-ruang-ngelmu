<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                {{-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> --}}
                <div class="sidebar-brand-text mx-3">Administator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{ (request()->is('admin/pengajar')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengajar.index') }}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i> 
                    <span>Mentor</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{ (request()->is('admin/course')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('course.index') }}">
                    <i class="far fa-address-card"></i>
                    <span>Course</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('keluar') }}">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            <!-- Heading -->
            {{-- <div class="sidebar-heading">
                Interface
            </div> --}}


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            

        </ul>
        <!-- End of Sidebar -->