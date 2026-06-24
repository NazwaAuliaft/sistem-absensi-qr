<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistem Absensi QR</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#eef2f7;
    font-family:'Segoe UI',sans-serif;
}

.navbar{
    background:linear-gradient(135deg,#0d6efd,#3d8bfd);
    box-shadow:0 3px 15px rgba(0,0,0,.15);
}

.dashboard-card{
    border:none;
    border-radius:20px;
    color:white;
    overflow:hidden;
    transition:.3s;
}

.dashboard-card:hover{
    transform:translateY(-4px);
}

.card-total{
    background:linear-gradient(135deg,#0d6efd,#4d9fff);
}

.card-hadir{
    background:linear-gradient(135deg,#198754,#41c77a);
}

.main-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.form-control{
    border-radius:12px;
}

.btn-primary{
    border-radius:12px;
}

.table{
    margin-bottom:0;
}

.badge{
    font-size:14px;
}

.clock{
    font-size:18px;
    font-weight:bold;
}

</style>

</head>
<body>

<nav class="navbar navbar-dark">
    <div class="container">

```
    <span class="navbar-brand fw-bold">
        <i class="bi bi-qr-code-scan"></i>
        Sistem Absensi QR
    </span>

    <span class="text-white clock" id="clock"></span>

</div>
```

</nav>

<div class="container mt-4">

```
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="row mb-4">

    <div class="col-md-6 mb-3">

        <div class="dashboard-card card-total p-4">

            <h5>
                <i class="bi bi-people-fill"></i>
                Total Absensi
            </h5>

            <h1>{{ $total }}</h1>

        </div>

    </div>

    <div class="col-md-6 mb-3">

        <div class="dashboard-card card-hadir p-4">

            <h5>
                <i class="bi bi-check-circle-fill"></i>
                Hadir Hari Ini
            </h5>

            <h1>{{ $hadirHariIni }}</h1>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-4 mb-4">

        <div class="card main-card">

            <div class="card-header bg-white fw-bold">
                <i class="bi bi-person-plus"></i>
                Form Absensi
            </div>

            <div class="card-body">

                <form action="/absen" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label>NIS</label>

                        <input
                            type="text"
                            name="nis"
                            class="form-control"
                            placeholder="Masukkan NIS"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Nama</label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan Nama"
                            required>

                    </div>

                    <button class="btn btn-primary w-100">

                        <i class="bi bi-check-circle"></i>

                        Simpan Absensi

                    </button>

                </form>

            </div>

        </div>

    </div>

    <div class="col-lg-8">

        <div class="card main-card">

            <div class="card-header bg-white fw-bold">

                <i class="bi bi-table"></i>

                Data Absensi

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead class="table-primary">

                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($attendances as $a)

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

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">
                                    Belum ada data absensi
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
```

</div>

<script>

function updateClock(){

    const now = new Date();

    document.getElementById("clock").innerHTML =
        now.toLocaleDateString('id-ID') +
        " " +
        now.toLocaleTimeString('id-ID');

}

setInterval(updateClock,1000);

updateClock();

</script>

</body>
</html>
