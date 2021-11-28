<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-text mx-3">Goubba Ad</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('dashboard') ? 'active':'' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
        </a>
    </li>
    {{-- <hr class="sidebar-divider">
    <div class="sidebar-heading">Advertiser Manager</div>
    <li class="nav-item {{ request()->is('advertiser/create') ? 'active':'' }}">
        <a class="nav-link" href="{{route('advertiser.create')}}">
            <i class="fas fa-fw fa-list"></i><span>Add Advertiser</span>
        </a>
    </li>
    <li class="nav-item {{request()->is('advertiser/list') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('advertiser.list') }}">
            <i class="fas fa-fw fa-list"></i><span>Advertisers</span>
        </a>
    </li> --}}
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Advertiser Manager</div>
    <li class="nav-item {{ request()->is('users/create') ? 'active':'' }}">
        <a class="nav-link" href="{{route('users.create')}}">
            <i class="fas fa-fw fa-list"></i><span>Add Advertiser</span>
        </a>
    </li>
    <li class="nav-item {{request()->is('users/list') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('users.list') }}">
            <i class="fas fa-fw fa-list"></i><span>Advertisers</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Campaign</div>
    <li class="nav-item {{request()->is('adv/create') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('adv.create')}}">
            <i class="fas fa-fw fa-list"></i><span>Create Campaign</span>
        </a>
    </li>
    <li class="nav-item {{request()->is('adv') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('adv.list')}}">
            <i class="fas fa-fw fa-list"></i><span>Campaign Lists</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
