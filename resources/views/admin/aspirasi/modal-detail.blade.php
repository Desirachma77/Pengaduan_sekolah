<div class="modal-overlay" id="modalDetail">
    <div class="modal-box">

        {{-- HEADER --}}
        <div class="modal-header-top">
            <div class="school-info">
                <img src="{{ asset('img/logo.png') }}" class="logo">
            </div>
            <div class="date-info">
                Tanggal : <span id="detailTanggal">27/01/2025</span>
            </div>
        </div>

        <hr>

        <h2 class="modal-title">Detail Aspirasi</h2>

        {{-- GRID UTAMA --}}
        <div class="detail-grid">

            <div class="form-group">
                <label>NIS Siswa<span>*</span></label>
                <input type="text" id="detailNis" readonly>
            </div>

            <div class="form-group">
                <label>Nama Siswa<span>*</span></label>
                <input type="text" id="detailNama" readonly>
            </div>

            <div class="form-group">
                <label>Kategori<span>*</span></label>
                <input type="text" id="detailKategori" readonly>
            </div>

            <div class="form-group">
                <label>Tempat<span>*</span></label>
                <input type="text" id="detailLokasi" readonly>
            </div>

            {{-- KIRI: KETERANGAN --}}
            <div class="form-group keterangan">
                <label>Keterangan<span>*</span></label>
                <textarea id="detailKeterangan" readonly></textarea>
            </div>

            {{-- KANAN: BUKTI + STATUS --}}
            <div class="bukti-wrapper">
                <label>Bukti<span>*</span></label>

                <div class="bukti-box">
                    <img id="detailBukti" src="">
                </div>

                <div class="status-wrapper">
    <label>Status<span>*</span></label>
    <span id="detailStatus" class="status-pill {{ strtolower($item->status) }}">
        {{ $item->status }}
    </span>
</div>

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="modal-footer">
            <button class="btn-outline" id="btnPdf">Simpan Bukti</button>
            <button class="btn-primary" id="btnKembali">Kembali</button>
        </div>

    </div>
</div>
