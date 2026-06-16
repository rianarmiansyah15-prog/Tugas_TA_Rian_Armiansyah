<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id_user='$id' AND role='teknisi'");

echo "<script>
    alert('Data teknisi berhasil dihapus');
    window.location='data_teknisi.php';
</script>";
?>