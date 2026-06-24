<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sistem Absensi Mahasiswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    margin:0;
}

.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    background:#0f172a;
    color:white;
    left:0;
    top:0;
}

.logo-area{
    text-align:center;
    padding:25px;
    border-bottom:1px solid rgba(255,255,255,.1);
}

.logo-area h4{
    margin-top:10px;
}

.sidebar-menu a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px 25px;
}

.sidebar-menu a:hover{
    background:#1e293b;
}

.content{
    margin-left:260px;
    padding:25px;
}

.card{
    border:none;
    border-radius:18px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

.stat-card{
    color:white;
}

.total-card{
    background:linear-gradient(135deg,#2563eb,#60a5fa);
}

.today-card{
    background:linear-gradient(135deg,#059669,#34d399);
}

</style>

</head>
<body>

<div class="sidebar">

    <div class="logo-area">

        <i class="bi bi-building fs-1"></i>

        <h4>Kampus Digital</h4>

        <small>Sistem Absensi Mahasiswa</small>

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

        <h2>
            Dashboard Absensi Mahasiswa
        </h2>

        <div id="clock"></div>

    </div>

    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card total-card stat-card p-4">

                <h5>Total Absensi</h5>

                <h1>{{ $total }}</h1>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card today-card stat-card p-4">

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
                            <th>Jam</th>
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

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

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

</script>

</body>
</html>