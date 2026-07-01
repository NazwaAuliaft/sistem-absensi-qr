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
        #reader { border: none !important; width: 100% !important; }
        #reader video { border-radius: 10px !important; object-fit: cover; }
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
            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
            <a href="{{ url('/absensi') }}" class="nav-link active"><i class="fas fa-user-check me-2"></i> Absensi</a>
            <a href="{{ url('/statistik') }}" class="nav-link"><i class="fas fa-chart-bar me-2"></i> Statistik</a>
        </div>
    </div>

    <div class="main-content">
        <div class="mb-4">
            <h2>Menu Pencatatan Absensi</h2>
            <p class="text-muted">Universitas Saintek Muhammadiyah • Silakan isi form atau scan QR Code</p>
        </div>

        <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none mb-4" role="alert" style="border-radius: 10px;">
            <i class="fas fa-check-circle me-2"></i> <strong>Sukses!</strong> Data absensi mahasiswa berhasil disimpan dan ditambahkan ke Dashboard.
            <button type="button" class="btn-close" onclick="document.getElementById('success-alert').classList.add('d-none')"></button>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 15px;">
                    <h5 class="mb-4 fw-bold text-dark"><i class="fas fa-edit text-primary me-2"></i> Form Absensi Manual</h5>
                    <form id="formAbsensi">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama Mahasiswa</label>
                            <input type="text" id="manual_nama" class="form-control" placeholder="Masukkan Nama Mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Tanggal</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Status Kehadiran</label>
                            <select class="form-select">
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 w-100" style="border-radius: 8px;">Kirim Absensi</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 15px; background: white;">
                    <h5 class="mb-4 fw-bold text-dark"><i class="fas fa-qrcode text-success me-2"></i> Scan QR Code Live</h5>
                    <div id="reader" class="bg-light rounded-3"></div>
                    <div id="scan-result" class="alert alert-success mt-3 d-none" role="alert">
                        <i class="fas fa-check-circle me-2"></i> QR Code Terdeteksi! NIM/Nama: <strong id="result-text"></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('scan-result').classList.remove('d-none');
            document.getElementById('result-text').innerText = decodedText;
            document.getElementById('manual_nama').value = decodedText;
            simpanAbsensiSukses();
        }

        function onScanFailure(error) {}

        let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} });
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        document.getElementById('formAbsensi').addEventListener('submit', function(e) {
            e.preventDefault();
            simpanAbsensiSukses();
        });

        function simpanAbsensiSukses() {
            // AMBIL DATA LAMA, TAMBAH 1, KEMUDIAN SIMPAN LAGI
            let currentAbsen = parseInt(localStorage.getItem('jumlahAbsen')) || 0;
            localStorage.setItem('jumlahAbsen', currentAbsen + 1);

            let alertBox = document.getElementById('success-alert');
            alertBox.classList.remove('d-none');
            document.getElementById('manual_nama').value = '';
            
            setTimeout(function() {
                alertBox.classList.add('d-none');
            }, 4000);
        }
    </script>
</body>
</html>