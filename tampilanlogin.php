<?php
// Memulai session
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "matyuk";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Jika form login disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama_pengguna = $_POST['nama_pengguna'];
  $alamat_email = $_POST['alamat_email'];
  $password = md5($_POST['password']);
  $nomor_hp = $_POST['nomor_hp'];
  $pilihan_jenjang = $_POST['pilihan_jenjang'];



  // Query ke database untuk cek username dan password
  $sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // Jika username dan password benar, simpan session dan redirect ke halaman selanjutnya
    $_SESSION['username'] = $username;
    header('Location: view.php');
    exit;
  } else {
    // Jika username dan password salah, tampilkan pesan error
    $error = "Username atau password salah!";
  }
}

?>

<!-- Tampilan form login -->
<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <div class = "container">
  <div class ="login">
    <h1>Sign Up</h1>
    <h4>New Free account</h4>
    <hr>
    <form method="post">
    <label for="nama_pengguna">Nama</label><br>
    <input type="text" name="username" required><br><br>
    <label>No.HP</label><br>
	<input type="text" name="nomor_hp" required><br><br>
    <label>Email</label><br>
	<input type="text" name="alamat_email" required><br><br>
    <label for="password">Password</label><br>
    <input type="password" name="password" required><br><br>
    <label>Jenjang</label><br>
		<select name="pilihan_jenjang" required>
			<option value="">Pilih Jenjang</option>
			<option value="10 IPA">10 IPA</option>
			<option value="10 IPS">10 IPS</option>
		</select><br><br>
		<input type="submit" value="Register"><br><br>
    <a href="forgotpw.php">Forgot Password?</a>
    <div class = "right">
    
    </div>
  </div>
  </div>
</body>
</html>


</form>

<?php
// Tampilkan pesan error jika ada
if (isset($error)) {
  echo $error;
}
?>