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
            <span>Dashboard</span>
        </a>

        <!-- ASPIRASI -->
        <a href="{{ route('siswa.aspirasi') }}" 
           class="menu-item {{ request()->routeIs('siswa.aspirasi*') ? 'active' : '' }}">
            <img src="{{ asset('img/aspirasi.png') }}">
            <span>Aspirasi</span>
        </a>

        <!-- STATUS DROPDOWN -->
        <div class="menu-item status-toggle 
             {{ request()->routeIs('siswa.status.*') ? 'open active' : '' }}" 
             id="statusToggle">

            <div class="status-left">
                <img src="{{ asset('img/refresh-cw-siswa.png') }}">
                <span>Status</span>
            </div>

            <img src="{{ asset('img/chevron-down-siswa.png') }}" class="status-arrow">
        </div>

        <!-- SUBMENU -->
        <div class="status-submenu 
             {{ request()->routeIs('siswa.status.*') ? 'show' : '' }}" 
             id="statusSubmenu">

            <!-- MENUNGGU -->
            <a href="{{ route('siswa.status.menunggu') }}" 
               class="submenu-item {{ request()->routeIs('siswa.status.menunggu*') ? 'active' : '' }}">
                <img src="{{ asset('img/menunggu-sidebar.png') }}">
                <span>Menunggu</span>
            </a>

            <!-- DIPROSES -->
            <a href="{{ route('siswa.status.diproses') }}" 
               class="submenu-item {{ request()->routeIs('siswa.status.diproses*') ? 'active' : '' }}">
                <img src="{{ asset('img/proses-sidebar.png') }}">
                <span>Diproses</span>
            </a>

            <!-- SELESAI -->
            <a href="{{ route('siswa.status.selesai') }}" 
               class="submenu-item {{ request()->routeIs('siswa.status.selesai*') ? 'active' : '' }}">
                <img src="{{ asset('img/selesai-siswa.png') }}">
                <span>Selesai</span>
            </a>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="sidebar-footer">
        <a href="{{ route('siswa.profil') }}" 
           class="submenu-item {{ request()->routeIs('siswa.profil*') ? 'active' : '' }}">
            <img src="{{ asset('img/profil.png') }}">
            <span>Profil</span>
        </a>
    </div>

</aside>
