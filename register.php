<?php
$role = isset($_GET['role']) ? $_GET['role'] : '';

if ($role != 'admin' && $role != 'teknisi') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Buat Akun <?php echo ucfirst($role); ?></title>
<style>
body{font-family:Arial;background:#f4f4f4;}
.register-box{
    width:400px;margin:80px auto;background:white;
    padding:30px;border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}
h2{text-align:center;color:#d50000;}
input,button{
    width:100%;padding:10px;margin-bottom:15px;
}
button{
    background:#d50000;color:white;border:none;cursor:pointer;
}
a{
    display:block;text-align:center;color:#d50000;
    text-decoration:none;
}
</style>
</head>
<body>

<div class="register-box">
    <h2>Buat Akun <?php echo ucfirst($role); ?></h2>

    <form action="proses_register.php" method="POST">
        <input type="hidden" name="role" value="<?php echo $role; ?>">

        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Daftar</button>
    </form>

    <a href="login.php?role=<?php echo $role; ?>">Sudah punya akun? Login</a>
</div>

</body>
</html>