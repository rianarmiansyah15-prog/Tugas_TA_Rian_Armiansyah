<?php
session_start();
include "../koneksi.php";

$id_pelanggan = $_POST['id_pelanggan'];
$jenis = $_POST['jenis_gangguan'];
$alamat = $_POST['alamat'];
$deskripsi = $_POST['deskripsi'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$foto = "";

if(isset($_FILES['foto_gangguan']) &&
   $_FILES['foto_gangguan']['error'] == 0){

    $foto = time() . "_" . basename($_FILES['foto_gangguan']['name']);

    move_uploaded_file(
        $_FILES['foto_gangguan']['tmp_name'],
        "../uploads/" . $foto
    );
}
$query = mysqli_query($conn,
"INSERT INTO tiket
(id_pelanggan, jenis_gangguan, alamat, deskripsi, foto, latitude, longitude)
VALUES
('$id_pelanggan','$jenis','$alamat','$deskripsi','$foto','$latitude','$longitude')");
if($query){
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Berhasil</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
}

.box{
    width:500px;
    margin:100px auto;
    background:white;
    padding:30px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

.btn{
    display:block;
    margin:10px auto;
    width:250px;
    padding:12px;
    background:#d50000;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.btn:hover{
    background:#a00000;
}
</style>
</head>

<body>

<div class="box">

<h2>✅ Laporan Berhasil Dikirim</h2>

<p>
Laporan gangguan WiFi Anda telah berhasil dikirim ke sistem.
</p>

<a class="btn" href="riwayat.php">
📋 Lihat Riwayat Laporan
</a>

<a class="btn" href="dashboard.php">
🏠 Kembali ke Dashboard
</a>

<a class="btn" href="../logout.php">
🚪 Logout
</a>

</div>

</body>
</html>

<?php
}else{
    echo mysqli_error($conn);
}
?>
