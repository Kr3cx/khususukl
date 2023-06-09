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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];
    $jenis_pengguna = $_POST['jenis_pengguna'];

    //menentukan nama tabel yang akan digunakan untuk memasukkan data
    $table_name = ($jenis_pengguna == 'guru') ? 'guru' : 'siswa';

    //mengecek apakah username sudah ada di tabel
    $check_query = "SELECT COUNT(*) as count FROM $table_name WHERE username = '$username'";
    $result = mysqli_query($connect, $check_query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count > 0) {
        echo "Nama sudah dipakai.";
        exit();
    }

    //query untuk memasukkan data ke database
    $query = "INSERT INTO $table_name (username, PASSWORD, no_hp) VALUES ('$username', '$password', '$no_hp')";

    //mengeksekusi query
    if (mysqli_query($connect, $query)) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Data gagal disimpan: " . mysqli_error($connect);
    }
}

//menutup koneksi ke database
mysqli_close($connect);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Register</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <form method="POST" action="">
        <div class="signup-text">
            <p>Sign up</p>
            <div class="FreeAccount">
                <p>New Free Account.</p>
                <div class="col-top">
                    <label>Username</label>
                    <input type="text" name="username" required autocomplete="off" placeholder="Username">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Password" minlength="4" maxlength="25">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" required autocomplete="off" placeholder="Nomor Handphone"
                        pattern="[0-9]+">
                    <label>Masuk Sebagai</label>
                    <select name="jenis_pengguna" required>
                        <option value="">-- Pilih Jenis Pengguna --</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                    </select>
                    <input type="submit" name="submit" value="Register">
                </div>
            </div>
        </div>
    </form>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>