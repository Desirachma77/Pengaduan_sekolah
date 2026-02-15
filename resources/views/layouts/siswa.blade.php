<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/sidebar-siswa.css') }}">
    <link rel="stylesheet" href="{{ asset('css/siswa.css') }}">
</head>
<body>

<div class="siswa-wrapper">

    {{-- SIDEBAR --}}
    <x-sidebar-siswa />

    <div class="siswa-main">

        {{-- NAVBAR --}}
        <x-navbar-siswa />

        {{-- CONTENT --}}
        <div class="siswa-content">
            @yield('content')
        </div>

    </div>
</div>

<script>
    const toggle = document.getElementById('statusToggle');
    const submenu = document.getElementById('statusSubmenu');

    toggle.addEventListener('click', () => {
        submenu.classList.toggle('show');
        toggle.classList.toggle('open');
    });
</script>

</body>
</html>
