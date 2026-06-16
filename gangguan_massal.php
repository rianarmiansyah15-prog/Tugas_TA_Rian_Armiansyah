<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

include "../koneksi.php";

if(isset($_POST['simpan'])){

    $daerah = $_POST['daerah'];
    $pesan = $_POST['pesan'];
    $latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

    mysqli_query($conn,"
INSERT INTO gangguan_massal
(daerah,pesan,status,latitude,longitude)
VALUES
('$daerah','$pesan','Aktif','$latitude','$longitude')
");

    echo "<script>
    alert('Pemberitahuan gangguan massal berhasil dibuat');
    window.location='gangguan_massal.php';
    </script>";
}

if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,"
    DELETE FROM gangguan_massal
    WHERE id='$id'
    ");

    echo "<script>
    alert('Data berhasil dihapus');
    window.location='gangguan_massal.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Gangguan Massal</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
}

.container{
    width:90%;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:10px;
}

h2{
    color:#d50000;
}

input,textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
}

button{
    background:#d50000;
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:5px;
    cursor:pointer;
}

.btn{
    background:#555;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
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

<h2>📢 Informasi Gangguan Massal</h2>

<a href="dashboard.php" class="btn">
🏠 Kembali Dashboard
</a>

<br><br>

<form method="POST">

<label>Daerah</label>
<input type="text" name="daerah"
placeholder="Contoh : Kertapati"
required>

<label>Pesan Gangguan</label>
<textarea name="pesan" rows="4" required></textarea>
<label>Latitude</label>
<input type="text" name="latitude" id="latitude" readonly>

<label>Longitude</label>
<input type="text" name="longitude" id="longitude" readonly>

<button type="button" onclick="ambilLokasi()">
📍 Ambil Lokasi Gangguan
</button>
<button type="submit" name="simpan">
💾 Simpan Informasi
</button>

</form>

<hr>

<h3>Daftar Gangguan Massal</h3>

<table>

<tr>
    <th>No</th>
    <th>Daerah</th>
    <th>Pesan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php

$no = 1;

$query = mysqli_query($conn,"
SELECT * FROM gangguan_massal
ORDER BY id DESC
");

while($data=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $data['daerah']; ?></td>

<td><?php echo $data['pesan']; ?></td>

<td><?php echo $data['status']; ?></td>

<td>

<a href="?hapus=<?php echo $data['id']; ?>"
onclick="return confirm('Hapus informasi ini?')">

🗑 Hapus

</a>

</td>

</tr>

<?php } ?>

</table>

</div>
<script>
function ambilLokasi(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(posisi){
            document.getElementById("latitude").value = posisi.coords.latitude;
            document.getElementById("longitude").value = posisi.coords.longitude;
            alert("Lokasi gangguan berhasil diambil");
        });
    }else{
        alert("Browser tidak mendukung lokasi");
    }
}
</script>
</body>
</html>