document.addEventListener('DOMContentLoaded', () => {
    const btn   = document.getElementById('ftBtn');
    const card  = document.getElementById('ftCard');
    const reset = document.getElementById('ftReset');

    // buka / tutup filter
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        card.classList.toggle('show');
    });

    // reset tanggal
    reset.addEventListener('click', () => {
        card.querySelectorAll('input[type="date"]').forEach(i => i.value = '');
    });

    // klik di luar → tutup
    document.addEventListener('click', (e) => {
        if (!card.contains(e.target) && !btn.contains(e.target)) {
            card.classList.remove('show');
        }
    });
});
