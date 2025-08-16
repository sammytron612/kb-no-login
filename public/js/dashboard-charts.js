document.addEventListener('DOMContentLoaded', async function() {
    const response = await fetch('/api/articles/most-viewed');
    const data = await response.json();
    const ctx = document.getElementById('mostViewedChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(a => a.title),
            datasets: [{
                label: 'Views',
                data: data.map(a => a.views),
                backgroundColor: 'rgba(37, 99, 235, 0.7)',
                borderRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { x: { title: { display: true, text: 'Article' } }, y: { title: { display: true, text: 'Views' }, beginAtZero: true } }
        }
    });
});
