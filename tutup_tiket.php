<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login_pelanggan.php");
    exit;
}

$id_tiket = $_GET['id'];
$id_pelanggan = $_SESSION['id_pelanggan'];

$query = mysqli_query($conn, "
    UPDATE tiket
    SET status='Ditutup Pelanggan'
    WHERE id_tiket='$id_tiket'
    AND id_pelanggan='$id_pelanggan'
");

if ($query) {
    echo "<script>
        alert('Laporan berhasil ditutup');
        window.location='riwayat.php';
    </script>";
} else {
    echo mysqli_error($conn);
}
?>