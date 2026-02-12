@extends('layouts.admin')

@section('navbar-title', 'Kelola Aspirasi')

@section('content')
<div class="card">
  <h3>Edit Aspirasi</h3>
  <p>Edit status aspirasi siswa</p>

  <form action="{{ route('admin.aspirasi.update', ['id' => $item->id_aspirasi]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid">
        <div>
            <label for="nis">NIS Siswa</label>
            <input id="nis" type="text" value="{{ $item->siswa_id }}" readonly>
        </div>

        <div>
            <label for="nama">Nama Siswa</label>
            <input id="nama" type="text" value="{{ $item->nama_siswa }}" readonly>
        </div>

        <div>
            <label for="lokasi">Lokasi</label>
            <input id="lokasi" type="text" value="{{ $item->lokasi }}" readonly>
        </div>

        <div>
            <label for="tanggal">Tanggal</label>
            <input id="tanggal" type="date" value="{{ $item->tanggal }}" readonly>
        </div>

        <div>
            <label for="kategori">Kategori</label>
            <input id="kategori" type="text" value="{{ $item->id_kategori }}" readonly>
        </div>

        <div>
            <label for="bukti">Bukti</label><br>
            @if($item->foto_bukti)
                <img src="{{ asset('storage/'.$item->foto_bukti) }}" width="250" alt="Bukti Aspirasi">
            @else
                <span>-</span>
            @endif
        </div>

        <div>
            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" readonly>{{ $item->ket_laporan }}</textarea>
        </div>

        <div>
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Menunggu" {{ $item->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Diproses" {{ $item->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
    </div>

    <div class="btn-area">
        <a href="{{ route('admin.history') }}" class="btn-cancel">Batal</a>
        <button type="submit" class="btn-save">Simpan</button>
    </div>
  </form>
</div>

<link rel="stylesheet" href="{{ asset('css/edit-aspirasi.css') }}">
@endsection
