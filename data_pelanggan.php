<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

$query = mysqli_query($conn, "
    SELECT * FROM pelanggan
    ORDER BY id_pelanggan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pelanggan</title>

<style>
body{font-family:Arial;background:#f4f6f9;}
.container{
    width:95%;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:10px;
}
h2{color:#d50000;}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    border:1px solid #ddd;
    padding:10px;
}
th{
    background:#d50000;
    color:white;
}
.btn{
    display:inline-block;
    background:#d50000;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
    margin-bottom:15px;
}
</style>
</head>

<body>

<div class="container">

<h2>👥 Data Pelanggan Terdaftar</h2>

<a href="dashboard.php" class="btn">🏠 Kembali ke Dashboard</a>

<table>
<tr>
    <th>No</th>
    <th>Nama Pelanggan</th>
    <th>Nomor Internet</th>
    <th>Email</th>
    <th>No HP</th>
    <th>Alamat</th>
    <th>Paket Internet</th>
</tr>

<?php
$no = 1;

if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['nama_pelanggan']; ?></td>
    <td><?php echo $data['nomor_internet']; ?></td>
    <td><?php echo $data['email']; ?></td>
    <td><?php echo $data['no_hp']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['paket']; ?></td>
</tr>

<?php
    }
} else {
?>

<tr>
    <td colspan="7" align="center">
        Belum ada pelanggan terdaftar.
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>