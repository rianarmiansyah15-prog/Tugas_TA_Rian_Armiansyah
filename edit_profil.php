<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teknisi') {
    header("Location: ../login.php?role=teknisi");
    exit;
}

include "../koneksi.php";

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn,"
SELECT * FROM users
WHERE id_user='$id_user'
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>

<html>
<head>
<title>Edit Profil Teknisi</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
}

.container{
    width:650px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}

h2{
    color:#d50000;
    text-align:center;
}

label{
    font-weight:bold;
}

input,
select{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
}
.btn{
    background:#d50000;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
}

.btn-kembali{
    background:#555;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    border-radius:8px;
}
</style>

</head>

<body>

<div class="container">

<h2>✏ Edit Profil Teknisi</h2>

<form action="update_profil.php" method="POST">

<input type="hidden" name="id_user"
value="<?php echo $data['id_user']; ?>">

<label>Nama Teknisi</label> <input type="text"
name="nama"
value="<?php echo $data['nama']; ?>"
required>

<label>Email</label> <input type="email"
name="email"
value="<?php echo $data['email']; ?>"
required>

<label>No HP</label>
<input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>">

<label>Alamat</label>
<input type="text" name="alamat" value="<?php echo $data['alamat']; ?>">

<label>Keahlian</label>
<input type="text" name="keahlian" value="<?php echo $data['keahlian']; ?>">

<label>Wilayah Kerja</label>
<input type="text" name="wilayah_kerja" value="<?php echo $data['wilayah_kerja']; ?>">

<label>Status Teknisi</label>
<select name="status_teknisi">
    <option value="Aktif" <?php if($data['status_teknisi']=="Aktif") echo "selected"; ?>>Aktif</option>
    <option value="Tidak Aktif" <?php if($data['status_teknisi']=="Tidak Aktif") echo "selected"; ?>>Tidak Aktif</option>
    <option value="Sedang Bertugas" <?php if($data['status_teknisi']=="Sedang Bertugas") echo "selected"; ?>>Sedang Bertugas</option>
</select>

<label>Password Baru</label> <input type="password"
name="password"
placeholder="Kosongkan jika tidak ingin mengganti">

<button type="submit" class="btn">
💾 Simpan Perubahan
</button>

<a href="profil.php" class="btn-kembali">
↩ Kembali
</a>

</form>

</div>

</body>
</html>
