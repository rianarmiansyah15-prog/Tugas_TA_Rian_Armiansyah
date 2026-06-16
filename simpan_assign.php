<?php
session_start();
include "../koneksi.php";

$id_tiket = $_POST['id_tiket'];
$id_teknisi = $_POST['id_teknisi'];

mysqli_query($conn,"
UPDATE tiket
SET id_teknisi='$id_teknisi',
status='Ditugaskan'
WHERE id_tiket='$id_tiket'
");

header("Location: assign_teknisi.php");
exit;
?>