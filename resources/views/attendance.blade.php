<!DOCTYPE html>
<html>
<head>
    <title>Sistem Absensi QR</title>
</head>
<body>

<h1>Sistem Absensi QR</h1>

@if(session('success'))
    <p style="color:green">
        {{ session('success') }}
    </p>
@endif

@if(session('error'))
    <p style="color:red">
        {{ session('error') }}
    </p>
@endif

<h2>Dashboard</h2>

<p>Total Absensi : {{ $total }}</p>
<p>Hadir Hari Ini : {{ $hadirHariIni }}</p>

<hr>

<h2>Form Absensi</h2>

<form action="/absen" method="POST">
    @csrf

    <input
        type="text"
        name="nis"
        placeholder="Masukkan NIS"
        required>

    <br><br>

    <input
        type="text"
        name="nama"
        placeholder="Masukkan Nama"
        required>

    <br><br>

    <button type="submit">
        Absen
    </button>
</form>

<hr>

<h2>Data Absensi</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>NIS</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Status</th>
    </tr>

    @foreach($attendances as $a)
    <tr>
        <td>{{ $a->nis }}</td>
        <td>{{ $a->nama }}</td>
        <td>{{ $a->tanggal }}</td>
        <td>{{ $a->jam_masuk }}</td>
        <td>{{ $a->status }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>