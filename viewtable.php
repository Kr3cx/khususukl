<!DOCTYPE html>
<html>

<head>
    <title>Data Siswa</title>
    <link rel="stylesheet" type="text/css" href="tampildata.css">
</head>

<body>
    <h1>Data Siswa</h1>
    <table border="1">
        <tr>
            <th>ID Siswa</th>
            <th>Username</th>
            <th>Password</th>
            <th>No. HP</th>
            <th>Aksi</th>
        </tr>
        <?php
        // memanggil file koneksi database
        include_once("sambung.php");

        // mengeksekusi query SELECT untuk mendapatkan data siswa
        $result = mysqli_query($host, "SELECT * FROM siswa");

        // memeriksa apakah data siswa ditemukan
        if (mysqli_num_rows($result) > 0) {
            // menampilkan data siswa
            while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td>
                        <?php echo $data['ID_SISWA']; ?>
                    </td>
                    <td>
                        <?php echo $data['username']; ?>
                    </td>
                    <td>
                        <?php echo $data['PASSWORD']; ?>
                    </td>
                    <td>
                        <?php echo $data['no_hp']; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $data['ID_SISWA']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $data['ID_SISWA']; ?>"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            // jika data siswa tidak ditemukan
            echo "<tr><td colspan='5'>Tidak ada data siswa .</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="formregister.php">Tambah Data Siswa</a>
</body>

</html>