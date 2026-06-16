<?php
session_start();
include "koneksi.php";

$nomor_internet = mysqli_real_escape_string(
    $conn,
    $_POST['nomor_internet']
);

$query = mysqli_query(
    $conn,
    "SELECT * FROM pelanggan
     WHERE nomor_internet='$nomor_internet'"
);

$data = mysqli_fetch_assoc($query);

if($data){

    $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
    $_SESSION['nama'] = $data['nama_pelanggan'];
    $_SESSION['nomor_internet'] = $data['nomor_internet'];

    header("Location: pelanggan/dashboard.php");
    exit;

}else{

    echo "<script>
            alert('Nomor Internet tidak ditemukan');
            window.location='login_pelanggan.php';
          </script>";
}
?>