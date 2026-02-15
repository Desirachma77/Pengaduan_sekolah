<div class="admin-navbar">
    <div class="navbar-left">
        <h1 class="navbar-title">
            @yield('navbar-title', 'Dashboard')
        </h1>
    </div>

    <div class="navbar-icons">
      <a href="{{ route('admin.history') }}">
    <img src="{{ asset('img/history.png') }}" alt="History">
</a>

       <div class="notif-wrapper">

    <img src="{{ asset('img/notif.png') }}"
         id="notifToggle"
         class="notif-icon"
         alt="Notifikasi">

    <div class="notif-panel" id="notifPanel">

        <div class="notif-header">
            <strong>Notifikasi</strong>
            <span class="notif-dot">3</span>
        </div>

        <div class="notif-body">

            <div class="notif-item">
                <b>Aspirasi Selesai</b>
                <span>Aspirasi telah selesai diproses</span>
            </div>

            <div class="notif-item">
                <b>Aspirasi Diproses</b>
                <span>Aspirasi sedang ditindaklanjuti</span>
            </div>

            <div class="notif-item">
                <b>Login Berhasil</b>
                <span>Anda login ke sistem</span>
            </div>

        </div>

        <div class="notif-footer">
            Tandai telah dibaca semua
        </div>

    </div>
</div>

    </div>
</div>