<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id' AND role='teknisi'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $keahlian = $_POST['keahlian'];
    $wilayah_kerja = $_POST['wilayah_kerja'];
    $status_teknisi = $_POST['status_teknisi'];

    mysqli_query($conn, "
        UPDATE users SET
        nama='$nama',
        email='$email',
        no_hp='$no_hp',
        alamat='$alamat',
        keahlian='$keahlian',
        wilayah_kerja='$wilayah_kerja',
        status_teknisi='$status_teknisi'
        WHERE id_user='$id'
    ");

    echo "<script>
        alert('Data teknisi berhasil diperbarui');
        window.location='data_teknisi.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Teknisi</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
.container{width:600px;margin:40px auto;background:white;padding:25px;border-radius:10px;}
input,textarea,select{width:100%;padding:10px;margin-bottom:15px;}
button,.btn{padding:10px 15px;border:none;border-radius:5px;text-decoration:none;color:white;}
button{background:#d50000;}
.btn{background:#333;}
</style>
</head>
<body>

<div class="container">
<h2>Edit Data Teknisi</h2>

<form method="POST">

<label>Nama</label>
<input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?php echo $data['email']; ?>" required>

<label>No HP</label>
<input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>">

<label>Alamat</label>
<textarea name="alamat"><?php echo $data['alamat']; ?></textarea>

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

<button type="submit" name="simpan">Simpan</button>
<a href="data_teknisi.php" class="btn">Kembali</a>

</form>
</div>

</body>
</html>