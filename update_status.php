<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teknisi') {
    header("Location: ../login.php?role=teknisi");
    exit;
}

include "../koneksi.php";

$id_tiket = $_POST['id_tiket'];
$status = $_POST['status'];

$query = mysqli_query($conn, "
    UPDATE tiket 
    SET status='$status'
    WHERE id_tiket='$id_tiket'
");

if ($query) {
    echo "<script>
        alert('Status tiket berhasil diperbarui');
        window.location='tiket.php';
    </script>";
} else {
    echo 'Gagal update status: ' . mysqli_error($conn);
}
?>