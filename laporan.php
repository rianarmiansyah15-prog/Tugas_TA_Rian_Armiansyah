<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

$where = "";

if ($filter == "minggu") {
    $where = "WHERE YEARWEEK(tiket.tanggal, 1) = YEARWEEK(CURDATE(), 1)";
} elseif ($filter == "bulan") {
    $where = "WHERE MONTH(tiket.tanggal) = MONTH(CURDATE())
              AND YEAR(tiket.tanggal) = YEAR(CURDATE())";
}

$query = mysqli_query($conn,"
SELECT
tiket.*,
pelanggan.nama_pelanggan,
pelanggan.nomor_internet,
pelanggan.no_hp,
users.nama AS nama_teknisi
FROM tiket
LEFT JOIN pelanggan
ON tiket.id_pelanggan = pelanggan.id_pelanggan
LEFT JOIN users
ON tiket.id_teknisi = users.id_user
$where
ORDER BY tiket.id_tiket DESC
");

?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Gangguan WiFi</title>

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
.btn{
    display:inline-block;
    background:#d50000;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
    margin:5px;
}
.btn-filter{
    background:#333;
}
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
th,td{
    border:1px solid #ddd;
    padding:10px;
}
th{
    background:#d50000;
    color:white;
}
</style>
</head>

<body>

<div class="container">

<h2>📊 Laporan Semua Gangguan WiFi</h2>

<a href="dashboard.php" class="btn">🏠 Dashboard</a>

<br><br>

<a href="laporan.php?filter=semua" class="btn btn-filter">Semua Data</a>
<a href="laporan.php?filter=minggu" class="btn btn-filter">Per Minggu Ini</a>
<a href="laporan.php?filter=bulan" class="btn btn-filter">Per Bulan Ini</a>
<a href="cetak_laporan.php" target="_blank" class="btn">
🖨 Cetak Laporan
</a>

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
<th>Teknisi</th>
<th>Rating</th>
<th>Ulasan</th>
<th>Tanggal</th>
<th>Aksi</th>
</tr>

<?php
$no = 1;

if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['nama_pelanggan'] ?: 'Data pelanggan tidak ditemukan'; ?></td>
    <td><?php echo $data['nomor_internet'] ?: '-'; ?></td>
    <td><?php echo $data['no_hp'] ?: '-'; ?></td>
    <td><?php echo $data['jenis_gangguan']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['deskripsi']; ?></td>
    <td><?php echo $data['status']; ?></td>
    <td>
<?php
if(!empty($data['nama_teknisi'])){
    echo $data['nama_teknisi'];
}else{
    echo "Belum Ditugaskan";
}
?>
</td>

<td>
<?php
if(!empty($data['rating'])){
    echo str_repeat("⭐", $data['rating']);
}else{
    echo "Belum ada rating";
}
?>
</td>

<td>
<?php
if(!empty($data['masukan'])){
    echo $data['masukan'];
}else{
    echo "Belum ada ulasan";
}
?>
</td>

<td><?php echo $data['tanggal']; ?></td>
<td>
    <a href="hapus_laporan.php?id=<?php echo $data['id_tiket']; ?>"
    onclick="return confirm('Yakin ingin menghapus laporan ini?')"
    style="background:#d50000;color:white;padding:7px 10px;text-decoration:none;border-radius:5px;">
        🗑 Hapus
    </a>
</td>
</tr>

<?php
    }
} else {
?>

<tr>
    <td colspan="9" align="center">
        Tidak ada data laporan gangguan.
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>