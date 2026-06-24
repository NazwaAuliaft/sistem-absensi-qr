<!DOCTYPE html>
<html>
<head>
    <title>Absensi QR</title>
</head>
<body>

<h2>Form Absensi</h2>

<form action="/absen" method="POST">
    @csrf

    <input type="text" name="nis" placeholder="NIS" required>
    <br><br>

    <input type="text" name="nama" placeholder="Nama" required>
    <br><br>

    <button type="submit">Absen</button>
</form>

<hr>

<h3>Data Absensi</h3>

<table border="1" cellpadding="5">
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