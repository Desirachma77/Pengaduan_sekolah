const modal = document.getElementById('modalDetail');

/* ================= OPEN MODAL ================= */
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-detail');
    if (!btn) return;

    modal.classList.add('show');
    document.body.classList.add('modal-open'); // lock scroll

    document.getElementById('detailNis').value        = btn.dataset.nis;
    document.getElementById('detailNama').value       = btn.dataset.nama;
    document.getElementById('detailKategori').value   = btn.dataset.kategori;
    document.getElementById('detailLokasi').value     = btn.dataset.lokasi;
    document.getElementById('detailKeterangan').value = btn.dataset.keterangan;
    document.getElementById('detailBukti').src        = btn.dataset.bukti;
    document.getElementById('detailStatus').innerText = btn.dataset.status;
});

/* ================= CLOSE MODAL ================= */
function closeModal() {
    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
}

/* tombol kembali */
document.addEventListener('click', function (e) {
    if (e.target.id === 'btnKembali') {
        closeModal();
    }
});

/* klik area gelap */
modal.addEventListener('click', function (e) {
    if (e.target === modal) {
        closeModal();
    }
});

/* tekan ESC */
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

/* ================= DOWNLOAD PDF ================= */
document.addEventListener('click', function (e) {
    if (e.target.id !== 'btnPdf') return;

    const nis        = document.getElementById('detailNis').value;
    const nama       = document.getElementById('detailNama').value;
    const kategori   = document.getElementById('detailKategori').value;
    const lokasi     = document.getElementById('detailLokasi').value;
    const keterangan = document.getElementById('detailKeterangan').value;
    const status     = document.getElementById('detailStatus').innerText;
    const tanggal    = document.getElementById('detailTanggal').innerText;

    const buktiSrc = document.getElementById('detailBukti').src;
    const bukti = buktiSrc.includes('/storage/')
        ? buktiSrc.split('/storage/')[1]
        : '';

    const params = new URLSearchParams({
        nis,
        nama,
        kategori,
        lokasi,
        keterangan,
        status,
        tanggal,
        bukti
    });

    // auto download PDF
    window.open('/admin/aspirasi/pdf?' + params.toString(), '_self');
});
