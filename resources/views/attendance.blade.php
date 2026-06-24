<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Absensi Mahasiswa USM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fc;
    margin:0;
}

.sidebar{
    width:270px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:#0f172a;
    color:white;
}

.logo-area{
    text-align:center;
    padding:20px;
    border-bottom:1px solid rgba(255,255,255,.1);
}

.logo-area img{
    width:110px;
}

.sidebar-menu a{
    display:block;
    padding:15px 25px;
    color:white;
    text-decoration:none;
}

.sidebar-menu a:hover{
    background:#1e293b;
}

.content{
    margin-left:270px;
    padding:25px;
}

.card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.total-card{
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    color:white;
}

.today-card{
    background:linear-gradient(135deg,#059669,#34d399);
    color:white;
}

.table{
    margin-bottom:0;
}

.card-header{
    background:white;
    font-weight:bold;
    border-bottom:1px solid #eee;
}

canvas{
    max-height:350px;
}

.card:hover{
    transform:translateY(-5px);
    transition:0.3s;
}

.sidebar{
    box-shadow:5px 0 20px rgba(0,0,0,.15);
}

#clock{
    font-weight:bold;
    background:white;
    padding:10px 20px;
    border-radius:15px;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
}

.logo-area img{
    background:white;
    padding:8px;
    border-radius:15px;
}

table tbody tr:hover{
    background:#f8fafc;
}

</style>

</head>
<body>

<div class="sidebar">

    <div class="logo-area">

        <img src="{{ asset('images/logo_banner_warna.png') }}" alt="Logo USM">

        <h5 class="mt-3">
            Universitas Saintek Muhammadiyah
        </h5>

        <small>
            Sistem Absensi Mahasiswa
        </small>

    </div>

    <div class="sidebar-menu">

        <a href="#">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="#">
            <i class="bi bi-person-check"></i>
            Absensi
        </a>

        <a href="#">
            <i class="bi bi-bar-chart"></i>
            Statistik
        </a>

    </div>

</div>

<div class="content">

    <div class="d-flex justify-content-between mb-4">

        <div>

            <h2 class="mb-0">
                Dashboard Absensi Mahasiswa
            </h2>

            <small class="text-muted">
                Universitas Saintek Muhammadiyah
            </small>

        </div>

        <div id="clock"></div>

    </div>

    <div class="card mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-2 text-center">

                    <img
                        src="{{ asset('images/logo_banner_warna.png') }}"
                        width="100">

                </div>

                <div class="col-md-10">

                    <h3>
                        Universitas Saintek Muhammadiyah
                    </h3>

                    <p class="mb-0">
                        Sistem Informasi Absensi Mahasiswa Berbasis QR Code
                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card total-card p-4">

                <h5>Total Absensi</h5>

                <h1>{{ $total }}</h1>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card today-card p-4">

                <h5>Hadir Hari Ini</h5>

                <h1>{{ $hadirHariIni }}</h1>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card">

                <div class="card-header">
                    Form Absensi Mahasiswa
                </div>

                <div class="card-body">

                    <form action="/absen" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label>NIM</label>

                            <input
                                type="text"
                                name="nis"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Nama Mahasiswa</label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Status Kehadiran</label>

                            <select
                                name="status"
                                class="form-control"
                                required>

                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpha">Alpha</option>

                        </select>

                    </div>

                    <button class="btn btn-primary w-100">
                        Simpan Absensi
                    </button>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">
                    Riwayat Absensi
                </div>

                <div class="card-body">

                    <table class="table table-striped">

                        <thead>

                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Status</th>
                        </tr>

                        </thead>

                        <tbody>

                        @foreach($attendances as $a)

                        <tr>

                            <td>{{ $a->nis }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->tanggal }}</td>
                            <td>{{ $a->jam_masuk }}</td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $a->status }}
                                </span>
                            </td>

                        </tr>

                        @endforeach

                       <div class="card mt-4">

    <div class="card-header fw-bold">
        📊 Statistik Kehadiran Mahasiswa
    </div>

    <div class="card-body">

        <canvas id="attendanceChart" height="120"></canvas>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

function updateClock(){

    const now = new Date();

    document.getElementById('clock').innerHTML =
        now.toLocaleDateString('id-ID')
        + ' '
        + now.toLocaleTimeString('id-ID');

}

setInterval(updateClock,1000);

updateClock();

const ctx = document.getElementById('attendanceChart');

const gradient = ctx.getContext('2d').createLinearGradient(0,0,0,400);

gradient.addColorStop(0,'#2563eb');
gradient.addColorStop(1,'#60a5fa');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'hadir',
            'izin',
            'sakit',
            'alpha'
        ],

        datasets: [{

            label: 'Jumlah Mahasiswa',

            data: [
                {{ $hadir }},
                {{ $izin }},
                {{ $sakit }},
                {{ $alpha }}
            ],

            backgroundColor: [
                '22c55e',
                '3b82f6',
                'f59e0b',
                'ef4444'
            ]

            borderRadius: 12,

        }]

    },

    options: {

        responsive: true,

        legend: {
            display:false
        }
    },

        scales: {

            y: {
                beginAtZero:true
            }

        }

    });

</script> 