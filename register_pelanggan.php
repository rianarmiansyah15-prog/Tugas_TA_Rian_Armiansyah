<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Buat Akun Pelanggan</title>

<style>
body{
    font-family:Arial;
    background:#f4f4f4;
}

.register-box{
    width:480px;
    margin:40px auto;
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

input, textarea, select{
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

.login{
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

<div class="register-box">

<h2>Buat Akun Pelanggan</h2>

<form action="proses_register_pelanggan.php" method="POST" autocomplete="off">

    <label>Nama Lengkap</label>
    <input type="text" name="nama_pelanggan" required>

<label>No HP</label>
<input
type="text"
name="no_hp"
maxlength="13"
placeholder="ex: 08xxxxxxxxxx"
pattern="08[0-9]{8,11}"
onkeypress="return event.charCode >= 48 && event.charCode <= 57"
required>

<label>Email</label>
<input
type="email"
name="email"
placeholder="ex: nama@gmail.com"
required>

    <label>Alamat</label>
    <textarea name="alamat" rows="3" required></textarea>


    <label>Paket Internet</label>
<select name="paket" required>
    <option value="">-- Pilih Paket --</option>
    <option value="IndiHome 20 Mbps - Rp.193.700/Bulan">
        IndiHome 20 Mbps - Rp.193.700/Bulan
    </option>
    <option value="IndiHome 50 Mbps - Rp.260.850/Bulan">
        IndiHome 50 Mbps - Rp.260.850/Bulan
    </option>
    <option value="IndiHome 75 Mbps - Rp.283.050/Bulan">
        IndiHome 75 Mbps - Rp.283.050/Bulan
        </option>
    <option value="IndiHome 150 Mbps - Rp.366.300/Bulan">
        IndiHome 150 Mbps - Rp.366.300/Bulan
    </option>
    <option value="IndiHome Gamer 200 Mbps - Rp.549.450/Bulan">
        IndiHome Gamer 200 Mbps - Rp.549.450/Bulan
    </option>
    <option value="IndiHome Premium 300 Mbps - Rp.999.000/Bulan">
        IndiHome Premium 300 Mbps - Rp.999.000/Bulan
    </option>
</select>
    <button type="submit">Daftar</button>

</form>

<a href="login_pelanggan.php" class="login">
    Sudah punya akun? Login
</a>

</div>

</body>
</html>