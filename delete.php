<?php
// memanggil file koneksi database
include_once("sambung.php");

// memeriksa apakah parameter id tersedia pada permintaan GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // mengeksekusi query DELETE untuk menghapus data siswa berdasarkan id
    $result = mysqli_query($host, "DELETE FROM siswa WHERE ID_SISWA=$id");

    // memeriksa apakah operasi DELETE berhasil atau gagal
    if ($result) {
        // mengatur ulang auto increment id pada tabel
        mysqli_query($host, "ALTER TABLE siswa AUTO_INCREMENT=1");

        // redirect ke halaman utama
        header("Location:viewtable.php");
    } else {
        // jika gagal, tampilkan pesan kesalahan
        echo "Gagal menghapus data siswa.";
    }
} else {
    // jika parameter id tidak tersedia, redirect ke halaman utama
    header("Location:viewtable.php");
}
?>