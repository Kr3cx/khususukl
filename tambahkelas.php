<?php
//koneksi ke database
$host = "localhost"; //nama host database
$username = "root"; //username database
$password = ""; //password database
$database = "matyuk"; //nama database

$connect = mysqli_connect($host, $username, $password, $database);

//memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

//jika form disubmit
if (isset($_POST['submit'])) {
    //mengambil data dari form
    $nama_kelas = $_POST['nama_kelas'];
    $jenjang_kelas = $_POST['jenjang_kelas'];
    $username = $_POST['username'];

    //mencari id_guru dari username
    $query = "SELECT ID_GURU FROM guru WHERE USERNAME='$username'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $id_guru = $row['ID_GURU'];

        //query untuk memeriksa apakah FK guru sudah memiliki kelas
        $query_cek_kelas = "SELECT COUNT(*) as jumlah_kelas FROM kelas WHERE ID_GURU='$id_guru'";
        $result_cek_kelas = mysqli_query($connect, $query_cek_kelas);
        if ($result_cek_kelas) {
            $row_cek_kelas = mysqli_fetch_array($result_cek_kelas);
            $jumlah_kelas = $row_cek_kelas['jumlah_kelas'];
        } else {
            $jumlah_kelas = null;
        }

        //jika FK guru sudah memiliki kelas, maka tampilkan pesan error
        if ($jumlah_kelas > 0) {
            echo "Tidak dapat membuat kelas lagi.";
            // redirect ke halaman landingpage.php
        } else {
            //query untuk memasukkan data ke database
            $query = "INSERT INTO kelas (NAMA_KELAS, JENJANG_KELAS, ID_GURU) VALUES ('$nama_kelas', '$jenjang_kelas', '$id_guru')";

            //mengeksekusi query
            if (mysqli_query($connect, $query)) {
                echo "Data berhasil disimpan.";
                // redirect ke halaman landingpage.php
                header('Location: landingpage.php');
                exit();
            } else {
                echo "Data gagal disimpan: " . mysqli_error($connect);
            }
        }
    } else {
        echo "Nama guru tidak terdaftar.";
    }
}

//menutup koneksi ke database
mysqli_close($connect);
?>

<!DOCTYPE html>
<html>

<head>
    <title>TAMBAH KELAS</title>
    <link rel="stylesheet" href="nambahdata1.css">
</head>

<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
        <label>Nama Kelas:</label><br>
        <input type="text" name="nama_kelas" required><br>

        <label>Jenjang Kelas:</label><br>
        <select name="jenjang_kelas" required>
            <option value="">-- Pilih Jenjang Yang Akan Diajar --</option>
            <option value="10 IPA">10 IPA</option>
            <option value="10 IPS">10 IPS</option>
        </select><br>

        <label>Username Guru Pengajar:</label><br>
        <input type="text" name="username" required><br>

        <button type="submit" name="submit">Simpan</button>
    </form>
</body>

</html>