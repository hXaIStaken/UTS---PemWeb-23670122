CREATE DATABASE IF NOT EXISTS db_obat;
USE db_obat;
CREATE TABLE IF NOT EXISTS obat (
    id_obat INT AUTO_INCREMENT PRIMARY KEY,
    nama_obat VARCHAR(255) NOT NULL,
    tgl_produksi DATE NOT NULL,
    tgl_expired DATE NOT NULL,
    perusahaan_farmasi VARCHAR(255) NOT NULL,
    deskripsi TEXT
);