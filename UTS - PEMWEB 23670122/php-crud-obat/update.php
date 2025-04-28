<?php 
include 'config.php'; 
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM obat WHERE id_obat=$id");
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Obat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Edit Data Obat</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" value="<?= $data['nama_obat'] ?>" required>
        </div>
        <div class="form-group">
            <label>Tanggal Produksi</label>
            <input type="date" name="tgl_produksi" class="form-control" value="<?= $data['tgl_produksi'] ?>" required>
        </div>
        <div class="form-group">
            <label>Tanggal Expired</label>
            <input type="date" name="tgl_expired" class="form-control" value="<?= $data['tgl_expired'] ?>" required>
        </div>
        <div class="form-group">
            <label>Perusahaan Farmasi</label>
            <input type="text" name="perusahaan_farmasi" class="form-control" value="<?= $data['perusahaan_farmasi'] ?>" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required><?= $data['deskripsi'] ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama_obat'];
        $tgl_produksi = $_POST['tgl_produksi'];
        $tgl_expired = $_POST['tgl_expired'];
        $perusahaan = $_POST['perusahaan_farmasi'];
        $deskripsi = $_POST['deskripsi'];
        $query = "UPDATE obat SET 
                    nama_obat='$nama', 
                    tgl_produksi='$tgl_produksi',
                    tgl_expired='$tgl_expired',
                    perusahaan_farmasi='$perusahaan',
                    deskripsi='$deskripsi' 
                  WHERE id_obat=$id";
        if ($conn->query($query) === TRUE) {
            echo "<div class='alert alert-success mt-3'>Data berhasil diupdate!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal update data.</div>";
        }
    }
    ?>
</body>
</html>