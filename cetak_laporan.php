<?php
session_start();

include "../koneksi.php";


date_default_timezone_set('Asia/Jakarta');

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
ORDER BY tiket.id_tiket DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cetak Laporan Gangguan WiFi</title>

<style>

body{
    font-family:Times New Roman;
    margin:30px;
}

.judul{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th,td{
    border:1px solid black;
    padding:8px;
    font-size:12px;
}

th{
    background:#ddd;
}

.ttd{
    margin-top:50px;
    width:300px;
    float:right;
    text-align:center;
}

</style>

</head>

<body onload="window.print()">

<div class="judul">

<h2>LAPORAN GANGGUAN WIFI INDIHOME</h2>

<h3>
Implementasi Sistem Manajemen Tiket Berbasis Web
Pada Layanan Gangguan WiFi IndiHome
</h3>

<hr>

</div>

<table>

<tr>
    <th>No</th>
    <th>Nama Pelanggan</th>
    <th>No Internet</th>
    <th>No HP</th>
    <th>Jenis Gangguan</th>
<th>Teknisi</th>
<th>Rating</th>
<th>Ulasan</th>
<th>Status</th>
<th>Tanggal</th>
</tr>

<?php
$no=1;

while($data=mysqli_fetch_assoc($query)){
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['nama_pelanggan']; ?></td>
    <td><?php echo $data['nomor_internet']; ?></td>
    <td><?php echo $data['no_hp']; ?></td>
   <td><?php echo $data['jenis_gangguan']; ?></td>

<td>
<?php
echo !empty($data['nama_teknisi'])
? $data['nama_teknisi']
: 'Belum Ditugaskan';
?>
</td>

<td>
<?php
if(!empty($data['rating'])){
    echo str_repeat('⭐',$data['rating']);
}else{
    echo '-';
}
?>
</td>

<td>
<?php
echo !empty($data['masukan'])
? $data['masukan']
: '-';
?>
</td>

<td><?php echo $data['status']; ?></td>
<td><?php echo $data['tanggal']; ?></td>
</tr>

<?php } ?>

</table>

<div class="ttd">

Palembang,
<?php echo date('d-m-Y'); ?>

<br><br><br><br>

<b><?php echo $_SESSION['nama']; ?></b>

</div>

</body>
</html>