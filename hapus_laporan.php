<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "
    DELETE FROM tiket
    WHERE id_tiket='$id'
");

echo "<script>
    alert('Laporan berhasil dihapus');
    window.location='laporan.php';
</script>";
?>