document.querySelectorAll('.tab-item').forEach(tab => {
    tab.addEventListener('click', () => {
        const status = tab.dataset.status;

        // aktifkan tab
        document.querySelectorAll('.tab-item')
            .forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        // tampilkan data sesuai status
        document.querySelectorAll('tbody tr').forEach(row => {
            row.style.display =
                row.dataset.status === status ? '' : 'none';
        });
    });
});
