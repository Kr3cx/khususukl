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
    $jenis_pengguna = $_POST['jenis_pengguna'];

    //menentukan nama tabel yang akan digunakan untuk mencari data
    $table_name = ($jenis_pengguna == 'guru') ? 'guru' : 'siswa';

    //query untuk mencari data pengguna
    $query = "SELECT * FROM $table_name WHERE username='$username' AND PASSWORD='$password'";

    //mengeksekusi query
    $result = mysqli_query($connect, $query);

    //mengecek apakah data pengguna ditemukan atau tidak
    if (mysqli_num_rows($result) == 1) {
        //jika ditemukan, set session variables
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["jenis_pengguna"] = $jenis_pengguna;
        //redirect ke halaman dashboard
        header('Location: landingpage.php');
        exit;
    } else {
        //jika tidak ditemukan, tampilkan pesan error
        $error_message = "Username atau password salah.";
    }
}

//menutup koneksi ke database
mysqli_close($connect);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <form method="POST" action="">
        <div class="signup-text">
            <p>Log in</p>
            <div class="FreeAccount">
                <?php if (isset($error_message)) { ?>
                    <div class="error">
                        <?php echo $error_message; ?>
                    </div>
                <?php } ?>
                <div class="col-top">
                    <label>Username</label>
                    <input type="text" name="username" required autocomplete="off" placeholder="Username">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Password" minlength="4" maxlength="25">
                    <label>Jenis Pengguna</label>
                    <select name="jenis_pengguna" required>
                        <option value="">-- Pilih Jenis Pengguna --</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                    </select>
                    <input type="submit" name="submit" value="Log in">
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