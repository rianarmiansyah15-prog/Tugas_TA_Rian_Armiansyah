<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teknisi') {
    header("Location: ../login.php?role=teknisi");
    exit;
}

include "../koneksi.php";

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "
    SELECT * FROM users
    WHERE id_user='$id_user'
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Teknisi</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
}

.container{
    width:600px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}

h2{
    text-align:center;
    color:#d50000;
}

.row{
    padding:15px;
    border-bottom:1px solid #ddd;
}

.label{
    font-weight:bold;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 15px;
    background:#d50000;
    color:white;
    text-decoration:none;
    border-radius:8px;
}
</style>
</head>

<body>

<div class="container">

<h2>👨‍🔧 Profil Teknisi</h2>

<div class="row">
    <span class="label">nama:</span><br>
    <?php echo $data['nama']; ?>
</div>

<div class="row">
    <span class="label">ID Teknisi:</span><br>
    <?php echo $data['id_teknisi']; ?>
</div>

<div class="row">
    <span class="label">No HP:</span><br>
    <?php echo $data['no_hp']; ?>
</div>

<div class="row">
    <span class="label">Alamat:</span><br>
    <?php echo $data['alamat']; ?>
</div>

<div class="row">
    <span class="label">Keahlian:</span><br>
    <?php echo $data['keahlian']; ?>
</div>

<div class="row">
    <span class="label">Wilayah Kerja:</span><br>
    <?php echo $data['wilayah_kerja']; ?>
</div>

<div class="row">
    <span class="label">Status Teknisi:</span><br>
    <?php echo $data['status_teknisi']; ?>
</div>

<a href="dashboard.php" class="btn">🏠 Kembali ke Dashboard</a>
<a href="edit_profil.php" class="btn">
✏ Edit Profil
</a>
<a href="../logout.php" class="btn">🚪 Logout</a>

</div>

</body>
</html>