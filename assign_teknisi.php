<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

include "../koneksi.php";

$tiket = mysqli_query($conn,"
SELECT 
tiket.*,
pelanggan.nama_pelanggan,
pelanggan.nomor_internet
FROM tiket
LEFT JOIN pelanggan
ON tiket.id_pelanggan = pelanggan.id_pelanggan
WHERE tiket.status='Menunggu'
ORDER BY tiket.id_tiket DESC
");

$teknisi = mysqli_query($conn,"
SELECT * FROM users
WHERE role='teknisi'
ORDER BY nama ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Assign Teknisi</title>
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
    cursor:pointer;
}
.btn{
    display:inline-block;
    background:#d50000;
    color:white;
    padding:10px;
    text-decoration:none;
    border-radius:5px;
    margin-bottom:15px;
}
</style>
</head>
<body>

<div class="container">

<h2>👨‍🔧 Assign Teknisi</h2>

<a href="dashboard.php" class="btn">🏠 Kembali ke Dashboard</a>

<table>
<tr>
    <th>No</th>
    <th>Nama Pelanggan</th>
    <th>No Internet</th>
    <th>Jenis Gangguan</th>
    <th>Alamat</th>
    <th>Status</th>
    <th>Pilih Teknisi</th>
</tr>

<?php
$no = 1;

if(mysqli_num_rows($tiket) > 0){
while($data = mysqli_fetch_assoc($tiket)){
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['nama_pelanggan']; ?></td>
    <td><?php echo $data['nomor_internet']; ?></td>
    <td><?php echo $data['jenis_gangguan']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['status']; ?></td>
    <td>
        <form action="simpan_assign.php" method="POST">

            <input type="hidden" name="id_tiket"
            value="<?php echo $data['id_tiket']; ?>">

            <select name="id_teknisi" required>
                <option value="">-- Pilih Teknisi --</option>

                <?php
                mysqli_data_seek($teknisi, 0);
                while($tk = mysqli_fetch_assoc($teknisi)){
                ?>
                    <option value="<?php echo $tk['id_user']; ?>">
                        <?php echo $tk['nama']; ?>
                    </option>
                <?php } ?>

            </select>

            <button type="submit">Assign</button>
        </form>
    </td>
</tr>

<?php
}
}else{
?>

<tr>
    <td colspan="7" align="center">
        Tidak ada tiket yang menunggu assign teknisi.
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>