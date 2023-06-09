<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" type="text/css" href="edit.css">
</head>

<body>
    <h1>Edit Data Siswa</h1>
    <?php
    // memanggil file koneksi database
    include_once("sambung.php");

    // memeriksa apakah parameter id tersedia pada permintaan GET
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // mengeksekusi query SELECT untuk mendapatkan data siswa berdasarkan id
        $result = mysqli_query($host, "SELECT * FROM siswa WHERE ID_SISWA=$id");

        // memeriksa apakah data siswa ditemukan
        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_array($result);
            ?>
            <form method="POST" action="edit.php?id=<?php echo $data['ID_SISWA']; ?>">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" value="<?php echo $data['username']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" value="<?php echo $data['PASSWORD']; ?>"></td>
                    </tr>
                    <tr>
                        <td>No. HP:</td>
                        <td><input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Simpan"></td>
                    </tr>
                </table>
            </form>
            <?php

            // memeriksa method permintaan
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // memeriksa input data
                $username = $_POST['username'];
                $password = $_POST['password'];
                $no_hp = $_POST['no_hp'];

                // mengupdate data siswa berdasarkan id
                $result = mysqli_query($host, "UPDATE siswa SET username='$username', PASSWORD='$password', no_hp='$no_hp' WHERE ID_SISWA=$id");

                // memeriksa apakah operasi UPDATE berhasil atau gagal
                if ($result) {
                    // jika berhasil, redirect ke halaman utama
                    header("Location:viewtable.php");
                } else {
                    // jika gagal, tampilkan pesan kesalahan
                    echo "Gagal mengubah data siswa.";
                }
            }
        } else {
            // jika data siswa tidak ditemukan, redirect ke halaman utama
            header("Location:viewtable.php");
        }
    } else {
        // jika parameter id tidak tersedia, redirect ke halaman utama
        header("Location:viewtable.php");
    }
    ?>
</body>

</html>