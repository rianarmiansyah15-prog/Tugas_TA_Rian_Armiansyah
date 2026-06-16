<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login_pelanggan.php");
    exit;
}

$id_tiket = $_GET['id'];
$id_pelanggan = $_SESSION['id_pelanggan'];

mysqli_query($conn, "
    DELETE FROM tiket
    WHERE id_tiket='$id_tiket'
    AND id_pelanggan='$id_pelanggan'
");

echo "<script>
    alert('Laporan berhasil dihapus');
    window.location='riwayat.php';
</script>";
?>