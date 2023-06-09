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
    $id_materi = $_POST['id_materi'];
    $judul_materi = $_POST['judul_materi'];
    $jenis_materi = $_POST['jenis_materi'];
    $isi_materi = $_POST['isi_materi'];

    //mengecek apakah ada file yang diupload
    if (isset($_FILES['file_dokumen']) && $_FILES['file_dokumen']['error'] == 0) {
        //mengambil informasi file yang diupload
        $file_size = $_FILES['file_dokumen']['size'];
        $file_tmp = $_FILES['file_dokumen']['tmp_name'];
        $file_type = $_FILES['file_dokumen']['type'];
        $file_content = file_get_contents($file_tmp);

        //query untuk mengupdate data di database
        $query = "UPDATE materi SET judul_materi='$judul_materi', jenis_materi='$jenis_materi', isi_materi='$isi_materi', file_dokumen='" . mysqli_real_escape_string($connect, $file_content) . "' WHERE id_materi='$id_materi'";

        //mengeksekusi query
        if (mysqli_query($connect, $query)) {
            echo "Data berhasil diupdate.";
            header("Location: tambahdata.php");
            exit;
        } else {
            echo "Data gagal diupdate: " . mysqli_error($connect);
        }
    } else {
        //query untuk mengupdate data di database tanpa file
        $query = "UPDATE materi SET judul_materi='$judul_materi', jenis_materi='$jenis_materi', isi_materi='$isi_materi' WHERE id_materi='$id_materi'";

        //mengeksekusi query
        if (mysqli_query($connect, $query)) {
            echo "Data berhasil diupdate.";
            header("Location: tambahdata.php");
            exit;
        } else {
            echo "Data gagal diupdate: " . mysqli_error($connect);
        }
    }
}

//jika $_GET["id"] ada, ambil data materi dari database
if (isset($_GET['id'])) {
    $id_materi = $_GET['id'];
    $query = "SELECT * FROM materi WHERE id_materi='$id_materi'";
    $result = mysqli_query($connect, $query);
    $materi = mysqli_fetch_assoc($result);
} else {
    //jika $_GET["id"] tidak ada, kembali ke halaman read.php
    header("Location: read.php");
    exit;
}

//menutup koneksi ke database
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>

<head>
    <title>EDIT MATERI</title>
    <link rel="stylesheet" href="edit2.css">
</head>

<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
        <input type="hidden" name="id_materi" value="<?= $materi['ID_MATERI'] ?>">
        <label>Judul Materi:</label><br>
        <input type="text" name="judul_materi" value="<?= $materi['judul_materi'] ?>" required><br>

        <label>Jenis Materi:</label><br>
        <select name="jenis_materi" required>
            <option value="">-- Pilih Jenis Materi --</option>
            <option value="LOGARITMA" <?= $materi['jenis_materi'] == 'LOGARITMA' ? 'selected' : '' ?>>LOGARITMA</option>
            <option value="ALJABAR" <?= $materi['jenis_materi'] == 'ALJABAR' ? 'selected' : '' ?>>ALJABAR</option>
            <option value="VEKTOR" <?= $materi['jenis_materi'] == 'VEKTOR' ? 'selected' : '' ?>>VEKTOR</option>
            <option value="EKSPONEN" <?= $materi['jenis_materi'] == 'EKSPONEN' ? 'selected' : '' ?>>EKSPONEN</option>
        </select><br>

        <label>Isi Materi:</label><br>
        <textarea name="isi_materi" rows="30" required><?= $materi['isi_materi'] ?></textarea><br>

        <label>Dokumen:</label><br>
        <input type="file" name="file_dokumen"><br>

        <button type="submit" name="submit">Update</button>
        <a href="read.php">Batal</a>
    </form>
</body>

</html>