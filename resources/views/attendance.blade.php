<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Mahasiswa USM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { height: 100vh; background-color: #111b27; color: white; position: fixed; width: 250px; }
        .sidebar .brand { padding: 20px; border-bottom: 1px solid #2c3e50; text-align: center; }
        .sidebar .brand h5 { margin-top: 10px; font-size: 16px; font-weight: bold; }
        .sidebar .brand p { font-size: 11px; color: #a0aec0; }
        .sidebar .nav-link { color: #a0aec0; padding: 12px 20px; display: block; text-decoration: none; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #1e2d3b; color: white; }
        .main-content { margin-left: 250px; padding: 30px; }
        .card-custom { border: none; border-radius: 15px; color: white; padding: 20px; margin-bottom: 20px; }
        .bg-blue { background-color: #0081c9; }
        .bg-green { background-color: #00af91; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo_banner_warna.png') }}" alt="Logo USM" width="70">
            <h5>Universitas Saintek Muhammadiyah</h5>
            <p>Sistem Absensi Mahasiswa</p>
        </div>
        <div class="mt-3">
            <a href="{{ url('/') }}" class="nav-link active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
            <a href="{{ url('/absensi') }}" class="nav-link"><i class="fas fa-user-check me-2"></i> Absensi</a>
            <a href="{{ url('/statistik') }}" class="nav-link"><i class="fas fa-chart-bar me-2"></i> Statistik</a>
        </div>
    </div>

    <div class="main-content">
        <div class="mb-4">
            <h2>Dashboard Absensi Mahasiswa</h2>
            <p class="text-muted">Universitas Saintek Muhammadiyah • Sistem Berbasis QR Code</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card-custom bg-blue d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Total Absensi</h5>
                        <h1 id="total-absensi" class="display-4 fw-bold">0</h1>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-custom bg-green d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Hadir Hari Ini</h5>
                        <h1 id="hadir-hari-ini" class="display-4 fw-bold">0</h1>
                    </div>
                    <i class="fas fa-user-clock fa-3x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-7">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 15px;">
                    <h5 class="mb-4 fw-bold text-dark"><i class="fas fa-qrcode text-primary me-2"></i> Buat QR Code Mahasiswa</h5>
                    <form id="qrForm">
                        <div class="mb-3">
                            <label class="form-label text-muted">NIM Mahasiswa</label>
                            <input type="text" id="qr_nim" class="form-control" placeholder="Masukkan NIM (Contoh: 2026001)" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama Mahasiswa</label>
                            <input type="text" id="qr_nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        <button type="submit" class="btn btn-primary px-4" style="border-radius: 8px;">Generate QR Code</button>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm border-0 p-4 text-center" style="border-radius: 15px; min-height: 290px;">
                    <h5 class="fw-bold text-dark text-start mb-3">Hasil QR Code</h5>
                    <div id="qr-placeholder" class="d-flex flex-column align-items-center justify-content-center text-muted h-100 mt-3">
                        <i class="fas fa-qrcode fa-4x mb-2 opacity-50"></i>
                        <p class="small">Isi form di sebelah kiri untuk memunculkan QR Code di sini</p>
                    </div>
                    <div id="qr-result" class="d-none">
                        <img id="qr-image" src="" alt="QR Code" class="img-fluid border p-2 bg-white shadow-sm mb-2" style="width: 180px;">
                        <p class="fw-bold text-dark mb-0" id="qr-text-label"></p>
                    </div>
                </div>
            </div>
        </div>

        <button onclick="resetData()" class="btn btn-sm btn-outline-danger mt-4"><i class="fas fa-trash me-1"></i> Reset Data Dashboard</button>
    </div>

    <script>
        let jumlahAbsen = localStorage.getItem('jumlahAbsen') || 0;
        document.getElementById('total-absensi').innerText = jumlahAbsen;
        document.getElementById('hadir-hari-ini').innerText = jumlahAbsen;

        // Logika membuat QR Code otomatis menggunakan API gratis
        document.getElementById('qrForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let nim = document.getElementById('qr_nim').value;
            let nama = document.getElementById('qr_nama').value;
            let gabungTeks = nim + " - " + nama;

            // Memanggil generator QR code API pihak ketiga
            let qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" + encodeURIComponent(gabungTeks);
            
            document.getElementById('qr-image').src = qrUrl;
            document.getElementById('qr-placeholder').classList.add('d-none');
            document.getElementById('qr-result').classList.remove('d-none');
            document.getElementById('qr-text-label').innerText = nama;
        });

        function resetData() {
            localStorage.clear();
            location.reload();
        }
    </script>
</body>
</html>