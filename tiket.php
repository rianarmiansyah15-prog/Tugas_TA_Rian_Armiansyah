<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teknisi') {
    header("Location: ../login.php?role=teknisi");
    exit;
}

include "../koneksi.php";

$id_teknisi_login = $_SESSION['id_user'];

$query = mysqli_query($conn,"
SELECT
tiket.*,
pelanggan.nama_pelanggan,
pelanggan.nomor_internet,
pelanggan.no_hp
FROM tiket
LEFT JOIN pelanggan
ON tiket.id_pelanggan = pelanggan.id_pelanggan
WHERE tiket.id_teknisi='$id_teknisi_login'
AND tiket.status != 'Ditutup Pelanggan'
ORDER BY tiket.id_tiket DESC
");

?>

<!DOCTYPE html>
<html>
<head>
<title>Tiket Gangguan Teknisi</title>

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
select,button{
    padding:8px;
}
button{
    background:#d50000;
    color:white;
    border:none;
}
.btn{
    display:inline-block;
    margin-bottom:15px;
    background:#d50000;
    color:white;
    padding:10px;
    text-decoration:none;
    border-radius:5px;
}
</style>
</head>

<body>

<div class="container">

<h2>🛠 Tiket Gangguan Pelanggan</h2>

<a href="dashboard.php" class="btn">🏠 Kembali ke Dashboard</a>

<table>
<tr>
    <th>No</th>
    <th>Nama Pelanggan</th>
    <th>No Internet</th>
    <th>No HP</th>
    <th>Jenis Gangguan</th>
    <th>Alamat</th>
    <th>Deskripsi</th>
    <th>Foto</th>
    <th>Status</th>
    <th>Maps</th>
    <th>Update Status</th>
</tr>

<?php
$no = 1;

while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo !empty($data['nama_pelanggan']) ? $data['nama_pelanggan'] : 'Data pelanggan tidak ditemukan'; ?></td>

<td><?php echo !empty($data['nomor_internet']) ? $data['nomor_internet'] : '-'; ?></td>

<td><?php echo !empty($data['no_hp']) ? $data['no_hp'] : '-'; ?></td><td><?php echo $data['jenis_gangguan']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['deskripsi']; ?></td>
    <td align="center">

<?php
if($data['foto'] != ""){
?>

<a href="../uploads/<?php echo $data['foto']; ?>" target="_blank">

<img
src="../uploads/<?php echo $data['foto']; ?>"
width="120"
height="90"
style="
border-radius:10px;
border:2px solid #ddd;
object-fit:cover;
">

</a>

<?php
}else{
    echo "Tidak Ada Foto";
}
?>

</td>
    <td><?php echo $data['status']; ?></td>

    <td>
        <?php if (!empty($data['latitude']) && !empty($data['longitude'])) { ?>
            <a target="_blank"
            href="https://www.google.com/maps?q=<?php echo $data['latitude']; ?>,<?php echo $data['longitude']; ?>">
            Lihat Maps
            </a>
        <?php } else { ?>
            Tidak ada lokasi
        <?php } ?>
    </td>

    <td>
        <form action="update_status.php" method="POST">
            <input type="hidden" name="id_tiket" value="<?php echo $data['id_tiket']; ?>">

            <select name="status" required>
                <option value="Menunggu" <?php if($data['status']=='Menunggu') echo 'selected'; ?>>
                    Menunggu
                </option>

                <option value="Ditugaskan" <?php if($data['status']=='Ditugaskan') echo 'selected'; ?>>
                    Ditugaskan
                </option>

                <option value="Dalam Perjalanan" <?php if($data['status']=='Dalam Perjalanan') echo 'selected'; ?>>
                    Dalam Perjalanan
                </option>

                <option value="Dalam Perbaikan" <?php if($data['status']=='Dalam Perbaikan') echo 'selected'; ?>>
                    Dalam Perbaikan
                </option>

                <option value="Selesai" <?php if($data['status']=='Selesai') echo 'selected'; ?>>
                    Selesai
                </option>
            </select>

            <button type="submit">Update</button>
        </form>
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>