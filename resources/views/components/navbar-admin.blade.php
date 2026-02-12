<div class="admin-navbar">
    <div class="navbar-left">
        <h1 class="navbar-title">
            @yield('navbar-title', 'Dashboard')
        </h1>
    </div>

   <div class="navbar-icons">
    <a href="{{ route('admin.history') }}" 
       class="nav-icon {{ request()->routeIs('admin.history') ? 'active' : '' }}">
        <img src="{{ asset('img/history.png') }}" alt="History">
    </a>

    <a href="#" class="nav-icon">
        <img src="{{ asset('img/notif.png') }}" alt="Notifikasi">
    </a>
</div>


</div>
