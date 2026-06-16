<?php
session_start();
include "koneksi.php";

$otp_input = $_POST['otp'];

if ($otp_input == $_SESSION['otp']) {

    $nomor_internet = $_SESSION['reg_nomor_internet'];
    $nama_pelanggan = $_SESSION['reg_nama_pelanggan'];
    $email = $_SESSION['reg_email'];
    $no_hp = $_SESSION['reg_no_hp'];
    $alamat = $_SESSION['reg_alamat'];
    $paket = $_SESSION['reg_paket'];

    $simpan = mysqli_query($conn, "
        INSERT INTO pelanggan
        (nomor_internet, nama_pelanggan, email, no_hp, alamat, paket)
        VALUES
        ('$nomor_internet', '$nama_pelanggan', '$email', '$no_hp', '$alamat', '$paket')
    ");

    if ($simpan) {
        echo "<script>
            alert('OTP benar. Registrasi berhasil.');
            window.location='login_pelanggan.php';
        </script>";
    } else {
        echo mysqli_error($conn);
    }

} else {
    echo "<script>
        alert('Kode OTP salah.');
        window.location='verifikasi_otp.php';
    </script>";
}
?>