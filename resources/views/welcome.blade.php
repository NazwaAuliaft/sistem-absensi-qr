<form action="/absensi" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Nama Mahasiswa" required>
    <input type="date" name="tanggal" required>
    <select name="status">
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
    </select>
    <button type="submit">Kirim Absensi</button>
</form>