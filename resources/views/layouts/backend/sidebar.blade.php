<!-- Sidebar Admin -->
@php use App\Models\User; @endphp
@if (User::find(auth('web')->id())->hasRole('admin'))
    <!-- Admin -->
    <li class="back-btn">
        <div class="mobile-back text-right">
            <span>Back</span>
            <i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
        </div>
    </li>
    <li class="sidebar-list"><a
            class="nav-link sidebar-title sidebar-link {{ request()->is('*dashboard*') ? __('active') : '' }}"
            href="{{ route('backend.admin.dashboard.index') }}"><i data-feather="home"></i><span>Dashboard</span></a>
    </li>

    <li class="sidebar-main-title">
        <div>
            <h6>Menu Data</h6>
        </div>
    </li>
    <li class="sidebar-list"><a
            class="nav-link sidebar-title sidebar-link {{ request()->is('*mahasiswa*') ? __('active') : '' }}"
            href="{{ route('backend.admin.mahasiswa.index') }}"><i
                data-feather="book-open"></i><span>Mahasiswa</span></a></li>

    <li class="sidebar-main-title">
        <div>
            <h6>Referensi</h6>
        </div>
    </li>
    <li class="sidebar-list"><a class="nav-link sidebar-title sidebar-link" href=""><i
                data-feather="bookmark"></i><span>Program Studi</span></a></li>
    <li class="sidebar-list"><a class="nav-link sidebar-title sidebar-link" href=""><i
                data-feather="bookmark"></i><span>Fakultas</span></a></li>

    <li class="sidebar-main-title">
        <div>
            <h6>Manajemen</h6>
        </div>
    </li>
    <li class="sidebar-list">
        <a class="nav-link sidebar-title sidebar-link {{ request()->is('*roles*') ? __('active') : '' }}"
            href="{{ route('trusty.roles.index') }}">
            <i data-feather="filter"></i><span>Roles</span>
        </a>
    </li>
    <li class="sidebar-list">
        <a class="nav-link sidebar-title sidebar-link {{ request()->is('*permissions*') ? __('active') : '' }}"
            href="{{ route('trusty.permissions.index') }}">
            <i data-feather="lock"></i><span>Permissions</span>
        </a>
    </li>
    <li class="sidebar-list">
        <a class="nav-link sidebar-title sidebar-link {{ request()->is('*user*') ? __('active') : '' }}"
            href="{{ route('trusty.users.index') }}">
            <i data-feather="users"></i><span>User</span>
        </a>
    </li>
@endif

<!-- Sidebar ... -->
@if (User::find(auth('web')->id())->hasRole('member'))

@endif
<!-- CONTOH SIDEBAR -->

<!-- <li class="sidebar-main-title">
    <div>
        <h6 class="lan-1">General</h6>
        <p class="lan-2">Dashboards,widgets &amp; layout.</p>
    </div>
</li> -->
<!-- <li class="sidebar-list"><a class="nav-link sidebar-title" href="#"><i data-feather=""></i><span>...</span></a>
    <ul class="sidebar-submenu">
        <li><a class="submenu-title" href="#">...<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
            <ul class="nav-sub-childmenu submenu-content">
                <li><a href="#">...</a></li>
                <li><a href="#">...</a></li>
            </ul>
        </li>
    </ul>
</li> -->
<!-- <li class="sidebar-list"><a class="nav-link sidebar-title" href="#"><i data-feather=""></i><span>...</span></a></li> -->
