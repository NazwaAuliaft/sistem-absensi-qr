<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi QR</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

    body{
        background:#f4f6f9;
    }

    .navbar{
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
    }

    .card{
        border:none;
        border-radius:15px;
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
    }

    .stat-card{
        color:white;
    }

    .table{
        background:white;
    }

</style>
```

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

```
    <span class="navbar-brand">
        <i class="bi bi-qr-code-scan"></i>
        Sistem Absensi QR
    </span>

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

    <div class="col-md-6">

        <div class="card stat-card bg-primary">
            <div class="card-body">

                <h5>
                    <i class="bi bi-people-fill"></i>
                    Total Absensi
                </h5>

                <h1>{{ $total }}</h1>

            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="card stat-card bg-success">
            <div class="card-body">

                <h5>
                    <i class="bi bi-check-circle-fill"></i>
                    Hadir Hari Ini
                </h5>

                <h1>{{ $hadirHariIni }}</h1>

            </div>
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-4">

        <div class="card">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Form Absensi
                </h5>
            </div>

            <div class="card-body">

                <form action="/absen" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            NIS
                        </label>

                        <input
                            type="text"
                            name="nis"
                            class="form-control"
                            placeholder="Masukkan NIS"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama
                        </label>

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

    <div class="col-md-8">

        <div class="card">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Data Absensi
                </h5>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

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
```

</div>

</body>
</html>
