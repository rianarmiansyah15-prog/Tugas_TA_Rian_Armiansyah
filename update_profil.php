<?php
session_start();
include "../koneksi.php";

$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$keahlian = $_POST['keahlian'];
$wilayah_kerja = $_POST['wilayah_kerja'];
$status_teknisi = $_POST['status_teknisi'];

if(!empty($password)){

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = mysqli_query($conn,"
        UPDATE users SET
        nama='$nama',
        email='$email',
        password='$password_hash',
        no_hp='$no_hp',
        alamat='$alamat',
        keahlian='$keahlian',
        wilayah_kerja='$wilayah_kerja',
        status_teknisi='$status_teknisi'
        WHERE id_user='$id_user'
    ");

}else{

    $query = mysqli_query($conn,"
        UPDATE users SET
        nama='$nama',
        email='$email',
        no_hp='$no_hp',
        alamat='$alamat',
        keahlian='$keahlian',
        wilayah_kerja='$wilayah_kerja',
        status_teknisi='$status_teknisi'
        WHERE id_user='$id_user'
    ");
}

if($query){
    echo "
    <script>
    alert('Profil berhasil diperbarui');
    window.location='profil.php';
    </script>
    ";
}else{
    echo mysqli_error($conn);
}
?>