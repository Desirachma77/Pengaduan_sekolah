const searchInput = document.getElementById('liveSearchAspirasi');
const rows = document.querySelectorAll('#aspirasiTableBody tr');

searchInput.addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();

        if (text.includes(keyword)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

