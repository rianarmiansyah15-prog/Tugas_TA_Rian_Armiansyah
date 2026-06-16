<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Pelanggan</title>

<style>
body{
    font-family:Arial;
    background:#f4f4f4;
}

.login-box{
    width:480px;
    margin:70px auto;
    background:white;
    padding:35px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    color:#d50000;
    font-size:28px;
}

label{
    font-size:18px;
}

input{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:18px;
    font-size:16px;
}

button{
    width:100%;
    padding:12px;
    background:#d50000;
    color:white;
    border:none;
    font-size:16px;
    cursor:pointer;
}

.daftar{
    display:block;
    text-align:center;
    margin-top:20px;
    color:#d50000;
    font-size:18px;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="login-box">

<h2>Login Pelanggan</h2>

<form action="proses_login_pelanggan.php" method="POST">

    <label>Nomor Internet / ID Pelanggan</label>
<input
type="text"
name="nomor_internet"
autocomplete="off"
placeholder="Masukkan Nomor Internet"
required>

    <button type="submit">Masuk</button>

</form>

<a href="register_pelanggan.php" class="daftar">
    Belum punya akun? Buat Akun
</a>

</div>

</body>
</html>