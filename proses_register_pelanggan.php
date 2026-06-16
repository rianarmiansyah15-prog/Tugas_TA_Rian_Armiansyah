<?php
include "koneksi.php";

$nama_pelanggan = $_POST['nama_pelanggan'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$paket = $_POST['paket'];

/* Membuat nomor internet otomatis */
$cek = mysqli_query($conn, "SELECT MAX(id_pelanggan) AS id_terakhir FROM pelanggan");
$data = mysqli_fetch_assoc($cek);

$nomor_urut = $data['id_terakhir'] + 1;
$nomor_internet = "11170" . str_pad($nomor_urut, 6, "0", STR_PAD_LEFT);

/* Simpan data pelanggan */
$simpan = mysqli_query($conn, "
    INSERT INTO pelanggan
    (nomor_internet, nama_pelanggan, email, no_hp, alamat, paket)
    VALUES
    ('$nomor_internet', '$nama_pelanggan', '$email', '$no_hp', '$alamat', '$paket')
");

if ($simpan) {

    $no_wa = $no_hp;

    if (substr($no_wa, 0, 1) == "0") {
        $no_wa = "62" . substr($no_wa, 1);
    }

    $pesan = "Halo $nama_pelanggan, Registrasi berhasil dan Silakan Gunakan Nomor Internet Anda untuk Proses Login: $nomor_internet ";

    $link_wa = "https://wa.me/$no_wa?text=" . urlencode($pesan);
?>

<!DOCTYPE html>
<html>
<head>
<title>Registrasi Berhasil</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
.box{
    width:500px;
    margin:100px auto;
    background:white;
    padding:30px;
    text-align:center;
    border-radius:10px;
}
.btn{
    display:block;
    background:#25D366;
    color:white;
    padding:12px;
    margin:10px;
    text-decoration:none;
    border-radius:5px;
}
.login{
    background:#d50000;
}
</style>
</head>
<body>
<div class="box">
    <h2>Registrasi Berhasil</h2>

    <p>
        Nomor Internet Anda telah dibuat.
        Silakan klik tombol di bawah untuk mengirim ke WhatsApp.
    </p>

    <a class="btn" target="_blank" href="<?php echo $link_wa; ?>">
        Kirim Nomor Internet ke WhatsApp
    </a>

    <a class="btn login" href="login_pelanggan.php">
        Login Pelanggan
    </a>
</div>
</body>
</html>

<?php
} else {
    echo "Gagal daftar: " . mysqli_error($conn);
}
?>