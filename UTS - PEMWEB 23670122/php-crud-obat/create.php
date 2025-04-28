<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Obat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Tambah Data Obat</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Produksi</label>
            <input type="date" name="tgl_produksi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Expired</label>
            <input type="date" name="tgl_expired" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Perusahaan Farmasi</label>
            <input type="text" name="perusahaan_farmasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama_obat'];
        $tgl_produksi = $_POST['tgl_produksi'];
        $tgl_expired = $_POST['tgl_expired'];
        $perusahaan = $_POST['perusahaan_farmasi'];
        $deskripsi = $_POST['deskripsi'];
        $query = "INSERT INTO obat (nama_obat, tgl_produksi, tgl_expired, perusahaan_farmasi, deskripsi) 
                  VALUES ('$nama', '$tgl_produksi', '$tgl_expired', '$perusahaan', '$deskripsi')";
        if ($conn->query($query) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Data berhasil disimpan!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal menyimpan data.</div>";
        }
    }
    ?>
</body>
</html>