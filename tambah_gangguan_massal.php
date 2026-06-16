<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php?role=admin");
    exit;
}

if (isset($_POST['simpan'])) {
    $daerah = $_POST['daerah'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($conn, "
        INSERT INTO gangguan_massal
        (daerah, keterangan, status)
        VALUES
        ('$daerah', '$keterangan', 'Aktif')
    ");

    echo "<script>
        alert('Pemberitahuan gangguan massal berhasil dibuat');
        window.location='dashboard.php';
    </script>";
}
?>

<form method="POST">
    <h2>Tambah Gangguan Massal</h2>

    <label>Daerah / Kecamatan</label><br>
    <input type="text" name="daerah" placeholder="Contoh: Kertapati" required><br><br>

    <label>Keterangan Gangguan</label><br>
    <textarea name="keterangan" required></textarea><br><br>

    <button type="submit" name="simpan">
        Simpan Pemberitahuan
    </button>
</form>