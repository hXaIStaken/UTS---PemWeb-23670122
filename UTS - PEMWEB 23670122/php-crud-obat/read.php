<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Data Obat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Daftar Obat</h2>
    <a href="create.php" class="btn btn-success mb-3">Tambah Data</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Obat</th>
                <th>Produksi</th>
                <th>Expired</th>
                <th>Perusahaan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM obat");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_obat']}</td>
                        <td>{$row['nama_obat']}</td>
                        <td>{$row['tgl_produksi']}</td>
                        <td>{$row['tgl_expired']}</td>
                        <td>{$row['perusahaan_farmasi']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>
                            <a href='update.php?id={$row['id_obat']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete.php?id={$row['id_obat']}' class='btn btn-danger btn-sm' onclick='return confirm("Yakin hapus?")'>Hapus</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>