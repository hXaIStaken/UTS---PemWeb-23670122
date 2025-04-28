<?php 
include 'config.php'; 
$id = $_GET['id'];
$conn->query("DELETE FROM obat WHERE id_obat=$id");
header("Location: read.php");
?>