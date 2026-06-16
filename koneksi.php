<?php
$host = "localhost";
$user = "root";
$pass = "12345678";
$db   = "indihome_ta";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>