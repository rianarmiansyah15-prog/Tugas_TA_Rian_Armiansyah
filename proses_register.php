<?php
include "koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];
$id_admin = "";

if($role == "admin"){
    $id_admin = "ADM" . rand(1000,9999);
}

$id_teknisi = "";

if ($role == "teknisi") {
    $id_teknisi = "TKS" . rand(1000,9999);
}

$cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Email sudah terdaftar');
        window.location='register.php?role=$role';
    </script>";
} else {

    $simpan = mysqli_query($conn, "
       INSERT INTO users
(id_admin,nama,email,password,role)
VALUES
('$id_admin','$nama','$email','$password','$role')
    ");

    if ($simpan) {
        echo "<script>
            alert('Akun berhasil dibuat, silakan login');
            window.location='login.php?role=$role';
        </script>";
    } else {
        echo 'Gagal daftar: ' . mysqli_error($conn);
    }
}
?>