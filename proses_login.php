<?php
session_start();
include "koneksi.php";

$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];
$role     = mysqli_real_escape_string($conn, $_POST['role']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' LIMIT 1");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo "<script>
        alert('Email belum terdaftar. Silakan buat akun terlebih dahulu.');
        window.location='login.php?role=$role';
    </script>";
    exit;
}

if (!password_verify($password, $user['password'])) {
    echo "<script>
        alert('Password salah.');
        window.location='login.php?role=$role';
    </script>";
    exit;
}

if ($user['role'] != $role) {
    echo "<script>
        alert('Role salah. Akun ini terdaftar sebagai $user[role], bukan $role.');
        window.location='login.php?role=$user[role]';
    </script>";
    exit;
}

$_SESSION['id_user'] = $user['id_user'];
$_SESSION['nama']    = $user['nama'];
$_SESSION['role']    = $user['role'];

if ($user['role'] == 'admin') {
    header("Location: admin/dashboard.php");
    exit;
} elseif ($user['role'] == 'teknisi') {
    header("Location: teknisi/dashboard.php");
    exit;
}
?>