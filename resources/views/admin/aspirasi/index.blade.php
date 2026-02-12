@extends('layouts.admin')

@section('navbar-title', 'Kelola Aspirasi')

@section('content')

{{-- ================= WELCOME CARD ================= --}}
<div class="welcome-card">
    <div class="welcome-text">
        <h2>Selamat Datang, Admin!</h2>
        <p>Kelola data aspirasi siswa dengan mudah di sini.</p>
    </div>
    <div class="welcome-image">
        <img src="{{ asset('img/admin.png') }}" alt="Welcome">
    </div>
</div>

{{-- ================= TABLE CARD ================= --}}
<div class="table-card">

    {{-- ================= TOOLBAR ================= --}}
    <div class="aspirasi-toolbar">

        {{-- SEARCH (LIVE) --}}
        <div class="search-box">
            <img src="{{ asset('img/cari.png') }}" alt="Cari">
            <input
                type="text"
                id="searchAspirasi"
                placeholder="Cari nama siswa, kategori, lokasi"
                autocomplete="off">
        </div>

        <div class="toolbar-right">

            <x-filter-tanggal
                :action="route('admin.aspirasi')"
                :preserve="[
                    'status' => $status,
                    'sort'   => request('sort')
                ]"
            />

            <form method="GET" action="{{ route('admin.aspirasi') }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="desc" {{ request('sort','desc') === 'desc' ? 'selected' : '' }}>
                        Terbaru - Lama
                    </option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>
                        Lama - Terbaru
                    </option>
                </select>
            </form>

        </div>
    </div>

    {{-- ================= TAB STATUS ================= --}}
    <div class="status-tab">
        <a href="{{ route('admin.aspirasi', ['status' => 'menunggu']) }}"
           class="tab-item menunggu {{ $status === 'menunggu' ? 'active' : '' }}">
            Menunggu <b>({{ $menungguCount }})</b>
        </a>

        <a href="{{ route('admin.aspirasi', ['status' => 'diproses']) }}"
           class="tab-item diproses {{ $status === 'diproses' ? 'active' : '' }}">
            Diproses <b>({{ $diprosesCount }})</b>
        </a>
    </div>

    {{-- ================= TABLE ================= --}}
    <table class="aspirasi-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody id="aspirasiTable">
        @foreach($aspirasi as $item)
            <tr>
                <td>{{ $aspirasi->firstItem() + $loop->index }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                <td>{{ $item->siswa?->nis ?? '-' }}</td>
                <td>{{ $item->siswa?->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->kategori?->ket_kategori ?? '-' }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->ket_laporan }}</td>
                <td>
                    @if ($item->foto_bukti)
                        <img src="{{ asset('storage/'.$item->foto_bukti) }}" class="bukti-img">
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                    <span class="status-badge {{ strtolower($item->status) }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="aksi-cell">
                    <button
                        class="btn-aksi btn-detail"
                        data-nis="{{ $item->siswa?->nis ?? '-' }}"
                        data-nama="{{ $item->siswa?->nama_lengkap ?? '-' }}"
                        data-kategori="{{ $item->kategori?->ket_kategori ?? '-' }}"
                        data-lokasi="{{ $item->lokasi }}"
                        data-keterangan="{{ $item->ket_laporan }}"
                        data-bukti="{{ $item->foto_bukti ? asset('storage/'.$item->foto_bukti) : '' }}"
                        data-status="{{ $item->status }}"
                    >
                        <img src="{{ asset('img/detail.png') }}">
                    </button>

                    <a href="{{ route('admin.aspirasi.edit', ['id' => $item->id_aspirasi]) }}" 
                        class="btn-edit"
                        data-nis="{{ $item->siswa?->nis ?? '-' }}"
                        data-nama="{{ $item->siswa?->nama_lengkap ?? '-' }}"
                        data-kategori="{{ $item->kategori?->ket_kategori ?? '-' }}"
                        data-lokasi="{{ $item->lokasi }}"
                        data-keterangan="{{ $item->ket_laporan }}"
                        data-bukti="{{ $item->foto_bukti ? asset('storage/'.$item->foto_bukti) : '' }}"
                        data-status="{{ $item->status }}"
                    >
                        <img src="{{ asset('img/edit.png') }}">
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- ================= FOOTER ================= --}}
    <div class="table-footer" id="paginationFooter">
        <span>
            Menampilkan {{ $aspirasi->firstItem() ?? 0 }}
            – {{ $aspirasi->lastItem() ?? 0 }}
            dari {{ $aspirasi->total() }} data
        </span>

        {{ $aspirasi->links('vendor.pagination.admin') }}
    </div>
</div>

{{-- ================= MODAL + ASSET ================= --}}
@include('admin.aspirasi.modal-detail')

<link rel="stylesheet" href="{{ asset('css/modal-detail.css') }}">
<script src="{{ asset('js/modal-detail.js') }}"></script>

{{-- ================= LIVE SEARCH ================= --}}
<script>
const searchInput = document.getElementById('searchAspirasi');
const tableBody   = document.getElementById('aspirasiTable');
const footer      = document.getElementById('paginationFooter');

let timer = null;

searchInput.addEventListener('keyup', function () {
    clearTimeout(timer);

    timer = setTimeout(() => {
        const keyword = this.value.trim();

        if (keyword === '') {
            location.reload();
            return;
        }

        fetch(`/admin/aspirasi/search?search=${encodeURIComponent(keyword)}&status={{ $status }}`)
            .then(res => res.json())
            .then(data => {
                tableBody.innerHTML = '';
                footer.style.display = 'none';

                if (!data.length) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="10" class="empty-table">Data tidak ditemukan</td>
                        </tr>`;
                    return;
                }

                data.forEach((item, index) => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.created_at.substring(0,10)}</td>
                            <td>${item.siswa?.nis ?? '-'}</td>
                            <td>${item.siswa?.nama_lengkap ?? '-'}</td>
                            <td>${item.kategori?.ket_kategori ?? '-'}</td>
                            <td>${item.lokasi}</td>
                            <td>${item.ket_laporan}</td>
                            <td>${item.foto_bukti ? `<img src="/storage/${item.foto_bukti}" class="bukti-img">` : '-'}</td>
                            <td><span class="status-badge ${item.status.toLowerCase()}">${item.status}</span></td>
                            <td class="aksi-cell">
                                <button class="btn-aksi btn-detail"
                                    data-nis="${item.siswa?.nis ?? '-'}"
                                    data-nama="${item.siswa?.nama_lengkap ?? '-'}"
                                    data-kategori="${item.kategori?.ket_kategori ?? '-'}"
                                    data-lokasi="${item.lokasi}"
                                    data-keterangan="${item.ket_laporan}"
                                    data-bukti="${item.foto_bukti ? '/storage/'+item.foto_bukti : ''}"
                                    data-status="${item.status}">
                                    <img src="/img/detail.png">
                                </button>
                            </td>
                        </tr>`;
                });
            });
    }, 300);
});
</script>

@endsection
