<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE role='teknisi' ORDER BY id_user DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Teknisi</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
.container{width:95%;margin:30px auto;background:white;padding:25px;border-radius:10px;}
h2{color:#d50000;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ddd;padding:10px;}
th{background:#d50000;color:white;}
.btn{padding:8px 12px;text-decoration:none;border-radius:5px;color:white;}
.edit{background:#2196F3;}
.hapus{background:#d50000;}
.kembali{background:#333;display:inline-block;margin-bottom:15px;}
</style>
</head>
<body>

<div class="container">
<h2>👨‍🔧 Data Teknisi</h2>

<a href="dashboard.php" class="btn kembali">🏠 Kembali</a>

<table>
<tr>
    <th>No</th>
    <th>ID Teknisi</th>
<th>Nama</th>
<th>Email</th>
    <th>No HP</th>
    <th>Alamat</th>
    <th>Keahlian</th>
    <th>Wilayah Kerja</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($data=mysqli_fetch_assoc($query)){ ?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['id_teknisi']; ?></td>
<td><?php echo $data['nama']; ?></td>
<td><?php echo $data['email']; ?></td>
    <td><?php echo $data['no_hp']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['keahlian']; ?></td>
    <td><?php echo $data['wilayah_kerja']; ?></td>
    <td><?php echo $data['status_teknisi']; ?></td>
    <td>
        <a href="edit_teknisi.php?id=<?php echo $data['id_user']; ?>" class="btn edit">Edit</a>
        <a href="hapus_teknisi.php?id=<?php echo $data['id_user']; ?>"
        onclick="return confirm('Yakin ingin menghapus teknisi ini?')"
        class="btn hapus">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>