<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistem Pelaporan Gangguan Wifi Indihome</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background-image:
    linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
    url("./images/palembang-smart-network.jpg");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
    min-height:100vh;
}


.header{
    text-align:center;
    color:white;
    padding-top:50px;
}

.logo{
    font-size:90px;
    color:#ff3d3d;
    margin-bottom:20px;
}

.header h1{
    font-size:42px;
    margin-bottom:10px;
}

.header p{
    font-size:18px;
}

.container{
    width:90%;
    margin:auto;
    margin-top:50px;
}

.role-container{
    display:flex;
    justify-content:center;
    gap:30px;
    flex-wrap:wrap;
}

.card{
    width:300px;
    background:white;
    padding:30px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-10px);
}

.card i{
    font-size:70px;
    color:#d50000;
    margin-bottom:15px;
}

.card h2{
    margin-bottom:15px;
    color:#d50000;
}

.card p{
    color:#555;
    margin-bottom:20px;
}

.btn{
    display:inline-block;
    padding:12px 25px;
    background:#d50000;
    color:white;
    text-decoration:none;
    border-radius:10px;
    transition:0.3s;
}

.btn:hover{
    background:#a00000;
}

.footer{
    text-align:center;
    color:white;
    margin-top:50px;
    padding-bottom:20px;
}

</style>
</head>

<body>

<div class="header">

    <div class="logo">
        <i class="fas fa-wifi"></i>
    </div>

    <marquee style="font-size:42px;font-weight:bold;color:white;">
    📡 Sistem Pelaporan Gangguan Wifi IndiHome 📡
</marquee>
    
    <marquee
direction="right"
scrollamount="5"
style="
color:#FFD700;
font-size:18px;
">

🌐 Layanan Pelaporan dan Monitoring Gangguan Internet Pelanggan IndiHome 🌐

</marquee>
</div>

<div class="container">

<div class="role-container">

    <div class="card">
        <i class="fas fa-user-shield"></i>
        <h2>Admin</h2>

        <p>
            Mengelola tiket gangguan, teknisi,
            pelanggan dan laporan sistem.
        </p>

        <a href="login.php?role=admin"
        class="btn">
        Login Admin
        </a>
    </div>

    <div class="card">
        <i class="fas fa-user-cog"></i>
        <h2>Teknisi</h2>

        <p>
            Menangani laporan gangguan
            serta memperbarui status perbaikan.
        </p>

        <a href="login.php?role=teknisi"
        class="btn">
        Login Teknisi
        </a>
    </div>

    <div class="card">
        <i class="fas fa-users"></i>
        <h2>Pelanggan</h2>

        <p>
            Membuat laporan gangguan
            dan memantau status penanganan.
        </p>

        <a href="login_pelanggan.php"
        class="btn">
        Login Pelanggan
        </a>
    </div>

</div>

</div>

<div class="footer">
    © Rian_Armiansyah_2311006
</div>

</body>
</html>
```
