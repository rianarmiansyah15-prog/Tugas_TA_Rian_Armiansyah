<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teknisi') {
    header("Location: ../login.php?role=teknisi");
    exit;
}

include "../koneksi.php";

$id_teknisi = $_SESSION['id_user'];

$notif = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM tiket
WHERE id_teknisi='$id_teknisi'
AND status='Ditugaskan'
");

$data_notif = mysqli_fetch_assoc($notif);
$total_notif = $data_notif['total'];
$q_gangguan = mysqli_query($conn,"
SELECT * FROM gangguan_massal
WHERE status='Aktif'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Teknisi</title>

<script>
window.onload = function(){

<?php if($total_notif > 0){ ?>

    document.getElementById("notifTeknisi").play();

<?php } ?>

}
</script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}



body{
    margin:0;
    padding:0;
    font-family:'Segoe UI',sans-serif;

    background:
    linear-gradient(
    rgba(0,0,0,0.55),
    rgba(0,0,0,0.55)
    ),
    url("../images/bg-palembang.jpg");

    background-size:cover;
    background-position:center center;
    background-repeat:no-repeat;
    background-attachment:fixed;

    min-height:100vh;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#d50000;
    color:white;
    position:fixed;
    padding:25px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
}

.sidebar a:hover{
    background:#a00000;
}

.content{
    margin-left:250px;
    padding:30px;
}

.header{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 3px 8px rgba(0,0,0,0.1);
    margin-bottom:25px;
}

.cards{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.card{
    background:white;
    width:250px;
    padding:25px;
    border-radius:12px;
    box-shadow:0 3px 8px rgba(0,0,0,0.1);
}

.icon{
    font-size:35px;
    margin-bottom:10px;
}

.card h3{
    color:#d50000;
}
</style>
</head>

<body>
<audio id="notifTeknisi">
    <source src="../sound/notifikasi.wav" type="audio/wav">
</audio>
<div class="sidebar">
    <h2>Teknisi</h2>
    <a href="dashboard.php">🏠 Beranda</a>
    <a href="tiket.php">🛠 Tiket Gangguan</a>
    <a href="riwayat.php">📋 Riwayat Perbaikan</a>
    <a href="profil.php">👨‍🔧 Profil Teknisi</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="content">
    <div class="header">
        <h1>Beranda Teknisi</h1>
        <p>Selamat datang, <?php echo $_SESSION['nama']; ?></p>
    </div>
    <?php while($g = mysqli_fetch_assoc($q_gangguan)){ ?>

<div style="
background:#ffebee;
border-left:6px solid #d50000;
padding:20px;
border-radius:10px;
margin-bottom:20px;
">

<h3 style="color:#d50000;">
🚨 GANGGUAN MASSAL
</h3>

<p>
<b>Daerah :</b>
<?php echo $g['daerah']; ?>
</p>

<p>
<b>Keterangan :</b>
<?php echo $g['pesan']; ?>
</p>

<p style="color:red;font-weight:bold;">
Segera lakukan pengecekan jaringan pada area tersebut.
</p>
<?php if(!empty($g['latitude']) && !empty($g['longitude'])){ ?>

<br>

<a target="_blank"
href="https://www.google.com/maps?q=<?php echo $g['latitude']; ?>,<?php echo $g['longitude']; ?>"
style="
background:#28a745;
color:white;
padding:8px 12px;
text-decoration:none;
border-radius:5px;
">
🌍 Lihat Lokasi Gangguan
</a>

<?php } ?>
</div>

<?php } ?>
    <?php if($total_notif > 0){ ?>

<div style="
background:#d1ecf1;
padding:15px;
border-radius:10px;
margin-bottom:20px;
">

🔔 Ada <?php echo $total_notif; ?> tiket baru dari Admin.

<br><br>

<a href="tiket.php"
style="
background:#17a2b8;
color:white;
padding:10px;
text-decoration:none;
border-radius:5px;
">
📋 Lihat Tiket
</a>

</div>

<?php } ?>

    <div class="cards">
        <div class="card">
            <div class="icon">🛠</div>
            <h3>Tiket Gangguan</h3>
            <p>Melihat daftar tiket gangguan pelanggan.</p>
        </div>

        <div class="card">
            <div class="icon">📋</div>
            <h3>Riwayat Perbaikan</h3>
            <p>Melihat riwayat pekerjaan yang sudah selesai.</p>
        </div>

        <div class="card">
            <div class="icon">👨‍🔧</div>
            <h3>Profil Teknisi</h3>
            <p>Informasi akun teknisi yang sedang login.</p>
        </div>
    </div>
</div>

</body>
</html>