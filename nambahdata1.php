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

        //query untuk memasukkan data ke database
        $query = "INSERT INTO materi (judul_materi, jenis_materi, isi_materi, file_dokumen) VALUES ('$judul_materi', '$jenis_materi', '$isi_materi', '" . mysqli_real_escape_string($connect, $file_content) . "')";

        //mengeksekusi query
        if (mysqli_query($connect, $query)) {
            echo "Data berhasil disimpan.";
            // redirect ke halaman tambahdata.php
            header('Location: tambahdata.php');
            exit();
        } else {
            echo "Data gagal disimpan: " . mysqli_error($connect);
        }
    } else {
        //query untuk memasukkan data ke database tanpa file
        $query = "INSERT INTO materi (judul_materi, jenis_materi, isi_materi) VALUES ('$judul_materi', '$jenis_materi', '$isi_materi')";

        //mengeksekusi query
        if (mysqli_query($connect, $query)) {
            echo "Data berhasil disimpan.";
            // redirect ke halaman tambahdata.php
            header('Location: tambahdata.php');
            exit();
        } else {
            echo "Data gagal disimpan: " . mysqli_error($connect);
        }
    }
}

//menutup koneksi ke database
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>

<head>
    <title>TAMBAH MATERI</title>
    <link rel="stylesheet" href="nambahdata1.css">
</head>

<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
        <label>Judul Materi:</label><br>
        <input type="text" name="judul_materi" required><br>

        <label>Jenis Materi:</label><br>
        <select name="jenis_materi" required>
            <option value="">-- Pilih Jenis Materi --</option>
            <option value="LOGARITMA">LOGARITMA</option>
            <option value="ALJABAR">ALJABAR</option>
            <option value="VEKTOR">VEKTOR</option>
            <option value="EKSPONEN">EKSPONEN</option>
        </select><br>

        <label>Isi Materi:</label><br>
        <textarea name="isi_materi" rows="30" required></textarea><br>

        <label>Dokumen:</label><br>
        <input type="file" name="file_dokumen"><br>

        <button type="submit" name="submit">Simpan</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>