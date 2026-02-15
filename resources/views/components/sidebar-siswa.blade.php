<aside class="sidebar-siswa">

    <!-- LOGO -->
    <div class="sidebar-logo">
        <img src="{{ asset('img/logo.png') }}">
    </div>

    <!-- MENU -->
    <div class="sidebar-menu">
   
        <!-- DASHBOARD -->
        <a href="{{ route('siswa.dashboard') }}" 
           class="menu-item {{ request()->routeIs('siswa.dashboard*') ? 'active' : '' }}">
            <img src="{{ asset('img/dashboard.png') }}">
            Dashboard
        </a>

        <!-- ASPIRASI -->
        <a href="{{ route('siswa.aspirasi') }}" 
           class="menu-item {{ request()->routeIs('siswa.aspirasi*') ? 'active' : '' }}">
            <img src="{{ asset('img/aspirasi.png') }}">
            Aspirasi
        </a>

        <!-- STATUS DROPDOWN -->
        <div class="menu-item status-toggle 
             {{ request()->routeIs('siswa.status.*') ? 'open active' : '' }}" 
             id="statusToggle">

            <div class="status-left">
                <img src="{{ asset('img/refresh-cw-siswa.png') }}">
                Status
            </div>

            <img src="{{ asset('img/chevron-down-siswa.png') }}" class="status-arrow">
        </div>

        <!-- SUBMENU -->
        <div class="status-submenu 
             {{ request()->routeIs('siswa.status.*') ? 'show' : '' }}" 
             id="statusSubmenu">

            <a href="{{ route('siswa.status.menunggu') }}" 
               class="submenu-item {{ request()->routeIs('siswa.status.menunggu*') ? 'active' : '' }}">
                <img src="{{ asset('img/menunggu-sidebar.png') }}">
                Menunggu
            </a>

            <a href="{{ route('siswa.status.diproses') }}" 
               class="submenu-item {{ request()->routeIs('siswa.status.diproses*') ? 'active' : '' }}">
                <img src="{{ asset('img/proses-sidebar.png') }}">
                Diproses
            </a>

            <a href="{{ route('siswa.status.selesai') }}" 
               class="submenu-item {{ request()->routeIs('siswa.status.selesai*') ? 'active' : '' }}">
                <img src="{{ asset('img/selesai-siswa.png') }}">
                Selesai
            </a>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="sidebar-footer">
        <a href="{{ route('siswa.profil') }}" 
           class="submenu-item {{ request()->routeIs('siswa.profil*') ? 'active' : '' }}">
            <img src="{{ asset('img/profil.png') }}">
            Profil
        </a>
    </div>

</aside>
