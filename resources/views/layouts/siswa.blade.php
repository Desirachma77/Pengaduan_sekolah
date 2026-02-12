<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>

    <link rel="stylesheet" href="{{ asset('css/sidebar-siswa.css') }}">

</head>
<body>

    <x-sidebar-siswa />

    {{-- Sidebar Siswa --}}
    @include('components.sidebar-siswa')

    <div class="content">
        @yield('content')
    </div>

    <script>
    const dropdown = document.querySelector('.dropdown-btn');
    const submenu = document.querySelector('.submenu');

    dropdown.addEventListener('click', () => {
        submenu.classList.toggle('active');
    });
</script>

<script src="{{ asset('js/sidebar-siswa.js') }}"></script>

</body>
</html>
