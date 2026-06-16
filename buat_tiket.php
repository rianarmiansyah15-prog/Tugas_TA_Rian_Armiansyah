<?php
session_start();

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login_pelanggan.php");
    exit;
}

include "../koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Buat Laporan Gangguan</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
}

.container{
    width:800px;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

input,select,textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
}

button{
    background:#d50000;
    color:white;
    border:none;
    padding:12px 20px;
    cursor:pointer;
}

.btn-dashboard{
    display:inline-block;
    background:#2196F3;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    border-radius:5px;
    margin-left:10px;
}

.btn-group{
    display:flex;
    align-items:center;
    gap:10px;
}

.lokasi{
    margin-bottom:15px;
    color:green;
}
</style>
</head>

<body>

<div class="container">

<h2>📝 Form Laporan Gangguan WiFi</h2>

<form action="simpan_tiket.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id_pelanggan" value="<?php echo $_SESSION['id_pelanggan']; ?>">

<label>Nomor Internet</label>
<input type="text" value="<?php echo $_SESSION['nomor_internet']; ?>" readonly>

<label>Jenis Gangguan</label>
<select name="jenis_gangguan" required>
    <option value="">-- Pilih Gangguan --</option>
    <option>Internet Putus</option>
    <option>Internet Lambat</option>
    <option>Modem Mati</option>
    <option>LOS Merah</option>
    <option>Gangguan TV Kabel</option>
</select>

<label>Alamat Gangguan</label>
<input
type="text"
name="alamat"
id="alamat"
placeholder="Masukkan alamat lengkap"
autocomplete="off"
required>
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">

<button type="button" onclick="ambilLokasi()">
📍 Ambil Lokasi Saya
</button>

<div id="hasilLokasi" class="lokasi"></div>

<label>Deskripsi Gangguan</label>
<textarea name="deskripsi" rows="5" required></textarea>

<label>Foto Gangguan (Opsional)</label>
<input type="file" name="foto_gangguan" accept="image/*">

<div class="btn-group">

    <button type="submit" class="btn-kirim">
        📨 Kirim Laporan
    </button>

    <a href="dashboard.php" class="btn-dashboard">
        🏠 Kembali ke Beranda
    </a>

</div>

</form>

</div>

<script>
function ambilLokasi(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(posisi){

            let lat = posisi.coords.latitude;
            let lng = posisi.coords.longitude;

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;

            document.getElementById("hasilLokasi").innerHTML =
            "<br>✅ Lokasi berhasil diambil<br>" +
            "<a target='_blank' href='https://www.google.com/maps?q=" + lat + "," + lng + "'>" +
            "🌍 Lihat Lokasi di Google Maps</a><br><br>";

        }, function(){
            alert("Gagal mengambil lokasi. Izinkan akses lokasi di browser.");
        });
    }else{
        alert("Browser tidak mendukung GPS");
    }
}
</script>

</body>
</html>