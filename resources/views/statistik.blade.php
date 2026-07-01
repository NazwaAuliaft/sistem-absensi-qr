<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Absensi USM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { height: 100vh; background-color: #111b27; color: white; position: fixed; width: 250px; }
        .main-content { margin-left: 250px; padding: 30px; }
    </style>
</head>
<body>

    <!-- Sidebar sama seperti sebelumnya -->
    <div class="sidebar">
        <div class="p-3 text-center"><h5>Universitas Saintek Muhammadiyah</h5></div>
        <a href="{{ url('/') }}" class="nav-link text-white p-3"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="{{ url('/absensi') }}" class="nav-link text-white p-3"><i class="fas fa-user-check me-2"></i> Absensi</a>
        <a href="{{ url('/statistik') }}" class="nav-link text-white p-3 active bg-primary"><i class="fas fa-chart-bar me-2"></i> Statistik</a>
    </div>

    <div class="main-content">
        <h2>Grafik Kehadiran</h2>
        <div class="card p-4 shadow-sm mt-4">
            <canvas id="absensiChart" height="100"></canvas>
        </div>
    </div>

    <script>
        // Mengambil data dari localStorage yang tadi disimpan di menu Absensi
        let dataAbsen = parseInt(localStorage.getItem('jumlahAbsen')) || 0;

        const ctx = document.getElementById('absensiChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Hari Ini'],
                datasets: [{
                    label: 'Jumlah Mahasiswa Hadir',
                    data: [dataAbsen], // Data otomatis masuk sini!
                    backgroundColor: '#00af91'
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    </script>
</body>
</html>