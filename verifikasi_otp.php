<?php
session_start();

$link_wa = $_GET['wa'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Verifikasi OTP</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
.box{
    width:450px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}
input,button{
    width:100%;
    padding:12px;
    margin-bottom:15px;
}
.btn-wa{
    display:block;
    background:#25D366;
    color:white;
    padding:12px;
    text-decoration:none;
    border-radius:5px;
    margin-bottom:15px;
}
button{
    background:#d50000;
    color:white;
    border:none;
}
</style>
</head>
<body>

<div class="box">
<h2>Verifikasi OTP WhatsApp</h2>

<p>Klik tombol di bawah untuk mengirim OTP ke WhatsApp.</p>

<a class="btn-wa" target="_blank" href="<?php echo $link_wa; ?>">
    Kirim OTP ke WhatsApp
</a>

<form action="cek_otp.php" method="POST">
    <input type="text" name="otp" placeholder="Masukkan kode OTP" required>
    <button type="submit">Verifikasi OTP</button>
</form>

</div>

</body>
</html>