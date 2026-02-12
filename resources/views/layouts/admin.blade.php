<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/sidebar-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter-tanggal.css') }}">
</head>
<body>

<div class="admin-wrapper">

    <x-sidebar-admin />

    <div class="admin-main">

        <x-navbar-admin />

        <div class="admin-content">
            @yield('content')
        </div>

    </div>
</div>

<script src="{{ asset('js/aspirasi-tab.js') }}" defer></script>
<script src="{{ asset('js/filter-tanggal.js') }}" defer></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/modal-reset-sandi.js') }}"></script>
<script src="{{ asset('js/aspirasi-live-search.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('profilToggle');
    const panel  = document.getElementById('adminPanel');

    if (!toggle || !panel) return;

    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        panel.classList.toggle('show');
    });

    document.addEventListener('click', function () {
        panel.classList.remove('show');
    });

});
</script>

</body>
</html>
