<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login_pelanggan.php");
    exit;
}

$id_tiket = $_POST['id_tiket'];
$id_pelanggan = $_SESSION['id_pelanggan'];
$rating = $_POST['rating'];
$masukan = $_POST['masukan'];

$query = mysqli_query($conn, "
    UPDATE tiket SET
    rating='$rating',
    masukan='$masukan'
    WHERE id_tiket='$id_tiket'
    AND id_pelanggan='$id_pelanggan'
");

if ($query) {
    echo "<script>
        alert('Terima kasih, penilaian berhasil dikirim');
        window.location='riwayat.php';
    </script>";
} else {
    echo mysqli_error($conn);
}
?>