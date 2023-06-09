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

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["file_dokumen"]["name"]);
$ehek = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


$judul_materi = $_POST['judul_materi'];
$jenis_materi = $_POST['jenis_materi'];
$isi_materi = $_POST['isi_materi'];

if (file_exists($target_file)) {
    $_SESSION['error'] = "File already exists.";
    $ehek = 0;
    header("Location: ../main.php");
    exit();
}

$allowedFileTypes = array("jpg", "png", "jpeg", "gif");
if (!in_array($imageFileType, $allowedFileTypes)) {
    $_SESSION['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
    $ehek = 0;
}

if ($ehek == 0) {
    echo "File was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["file_dokumen"]["tmp_name"], $target_file)) {

        $sql = "INSERT INTO materi(judul_materi, jenis_materi, file_dokumen, isi_materi) 
                VALUES ('$judul_materi', '$jenis_materi', '$file_dokumen', '$isi_materi')";
        if (mysqli_query($connection, $sql)) {
            echo "File uploaded and data inserted into database.";
        } else {
            echo "Error inserting data into database: " . mysqli_error($connection);
        }
    } else {
        echo "Error uploading file.";
    }
}

header("Location: ../main.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Materi</title>
</head>

<body>
    <h2>Form Tambah Materi</h2>
    <form action="proses_tambah_materi.php" method="POST" enctype="multipart/form-data">
        <label for="judul_materi">Judul Materi:</label><br>
        <input type="text" id="judul_materi" name="judul_materi"><br>

        <label for="jenis_materi">Jenis Materi:</label><br>
        <select name="jenis_materi" id="jenis_materi">
            <option value="Materi 1">Materi 1</option>
            <option value="Materi 2">Materi 2</option>
            <option value="Materi 3">Materi 3</option>
        </select><br>

        <label for="file_dokumen">File Dokumen:</label><br>
        <input type="file" id="file_dokumen" name="file_dokumen"><br>

        <label for="isi_materi">Isi Materi:</label><br>
        <textarea id="isi_materi" name="isi_materi"></textarea><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>