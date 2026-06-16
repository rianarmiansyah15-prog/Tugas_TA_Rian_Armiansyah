<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

include "../koneksi.php";

$query = mysqli_query($conn,"
SELECT
tiket.*,
pelanggan.nama_pelanggan,
pelanggan.nomor_internet,
pelanggan.no_hp
FROM tiket
LEFT JOIN pelanggan
ON tiket.id_pelanggan = pelanggan.id_pelanggan
ORDER BY tiket.id_tiket DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Semua Tiket</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
.container{width:95%;margin:30px auto;background:white;padding:25px;border-radius:10px;}
h2{color:#d50000;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ddd;padding:10px;}
th{background:#d50000;color:white;}
.btn{background:#d50000;color:white;padding:10px;text-decoration:none;border-radius:5px;}
</style>
</head>
<body>

<div class="container">
<h2>🎫 Semua Tiket Laporan Pelanggan</h2>

<a href="dashboard.php" class="btn">🏠 Kembali ke Dashboard</a>
<br><br>

<table>
<tr>
    <th>No</th>
    <th>Nama Pelanggan</th>
    <th>No Internet</th>
    <th>No HP</th>
    <th>Jenis Gangguan</th>
    <th>Alamat</th>
    <th>Deskripsi</th>
    <th>Status</th>
    <th>Tanggal</th>
    <th>Maps</th>
</tr>

<?php $no=1; while($data=mysqli_fetch_assoc($query)){ ?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['nama_pelanggan'] ?: 'Data pelanggan tidak ditemukan'; ?></td>
    <td><?php echo $data['nomor_internet'] ?: '-'; ?></td>
    <td><?php echo $data['no_hp'] ?: '-'; ?></td>
    <td><?php echo $data['jenis_gangguan']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['deskripsi']; ?></td>
    <td><?php echo $data['status']; ?></td>
    <td><?php echo $data['tanggal']; ?></td>
    <td>
        <?php if(!empty($data['latitude']) && !empty($data['longitude'])){ ?>
            <a target="_blank" href="https://www.google.com/maps?q=<?php echo $data['latitude']; ?>,<?php echo $data['longitude']; ?>">
                Lihat Maps
            </a>
        <?php }else{ ?>
            Tidak ada lokasi
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>