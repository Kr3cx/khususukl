<?php
require "sambung.php";

$siswa = ("SELECT * FROM siswa order by ID_SISWA desc");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data siswa</title>
</head>

<body>
    <h1> Tabel Siswa</h1>
    <a href="formregister.php">Tambah Data</a><br><br>
    <table border="1" cellspacing="0" cellpading="3">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Password</th>
            <th>No Hp</th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($siswa as $swa):
            $id = $swa["ID_SISWA"];
            ?>
            <tr>
                <td>
                    <?= $no++; ?>
                </td>
                <td>
                    <?= $swa["username"]; ?>
                </td>
                <td>
                    <?= $swa["PASSWORD"]; ?>
                </td>
                <td>
                    <?= $swa["no_hp"]; ?>
                </td>
                <td>
                    <a href="viewtable2.php?deleteid_siswa=<?= $id ?>">Hapus</a> |
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>