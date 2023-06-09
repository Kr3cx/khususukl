<?php
// mengaktifkan session pada php
session_start();
include 'sambung.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($mysqli, "select * from user where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if ($data['level'] == "admin") {

        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        // alihkan ke halaman dashboard admin
        header("location:admin/index.php");

        // cek jika user login sebagai pegawai
    } else if ($data['level'] == "user") {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "user";
        // alihkan ke halaman dashboard pegawai
        header("location:user/index.php");

    } else {

        // alihkan ke halaman login kembali
        header("location:index.php");
    }
} else {
    header("location:index.php?pesan=gagal");
}


?>