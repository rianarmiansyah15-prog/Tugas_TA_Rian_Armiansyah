<?php
$role = isset($_GET['role']) ? $_GET['role'] : '';

if ($role == 'pelanggan') {
    header("Location: login_pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login <?php echo ucfirst($role); ?></title>
<style>
body{font-family:Arial;background:#f4f4f4;}
.login-box{
    width:400px;margin:100px auto;background:white;
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

<div class="login-box">
    <h2>Login <?php echo ucfirst($role); ?></h2>

    <form action="proses_login.php" method="POST">
        <input type="hidden" name="role" value="<?php echo $role; ?>">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>

    <a href="register.php?role=<?php echo $role; ?>">
        Belum punya akun? Buat Akun
    </a>
</div>

</body>
</html>