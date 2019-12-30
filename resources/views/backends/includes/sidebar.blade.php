<ul class="navbar-nav bg-gradient-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Faculty -->
    <a class="sidebar-faculty d-flex align-items-center justify-content-sm-around" href="{{route('dashboard.index')}}">
        <div class="sidebar-faculty-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-faculty-text mx-3">Student <sup>MANAGE</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt text-primary"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <i class="text-white fa fa-cogs"></i>
        <span>Quản lí</span>
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('view-user')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('users.index')}}" title="Quản lí người dùng">
                <i class="fas fa-fw fa-user-alt text-danger"></i>
                <span>Người dùng</span>
            </a>
        </li>
    @endcan
    @can('view-role')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('roles.index')}}" title="Quản lí nhóm quyền">
                <i class="fas fa-fw fa-user-alt text-danger"></i>
                <span>Quyền và nhóm quyễn</span>
            </a>
        </li>
    @endcan
    @can('view-student')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('students.index')}}" title="Quản lí sinh viên">
                <i class="text-warning fas fa-user-friends"></i>
                <span>Sinh viên</span>
            </a>
        </li>
    @endcan
    @can('view-classroom')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('classrooms.index')}}" title="Quản lí Lớp">
                <i class="text-success fas fa-users"></i>
                <span>Lớp học</span>
            </a>
        </li>
    @endcan
    @can('view-subject')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('subjects.index')}}" title="Quản lí môn học">
                <i class="text-success fas fa-users"></i>
                <span>Môn học</span>
            </a>
        </li>
    @endcan
    @can('view-faculty')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('faculties.index')}}" title="Quản lí khoa">
                <i class="text-primary fas fa-igloo"></i>
                <span>Khoa</span>
            </a>
        </li>
    @endcan

<!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        <i class="text-danger fa fa-cog"></i>
        <span>Cài đặt</span>
    </div>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
