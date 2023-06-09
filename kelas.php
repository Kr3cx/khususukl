<?php
require "ambung.php";

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $jenis = $_POST["jenis"];
    if ($jenis == "") {
        $kelas = tampel("SELECT kelas.ID_KELAS, kelas.nama_kelas, kelas.jenjang_kelas, kelas.ID_GURU, guru.username as pengajar FROM kelas INNER JOIN guru ON kelas.ID_GURU = guru.ID_GURU WHERE kelas.nama_kelas LIKE '%$keyword%' ORDER BY kelas.ID_KELAS DESC");
    } else {
        $kelas = tampel("SELECT kelas.ID_KELAS, kelas.nama_kelas, kelas.jenjang_kelas, kelas.ID_GURU, guru.username as pengajar FROM kelas INNER JOIN guru ON kelas.ID_GURU = guru.ID_GURU WHERE kelas.jenjang_kelas='$jenis' AND kelas.nama_kelas LIKE '%$keyword%' AND guru.ID_GURU = kelas.ID_GURU ORDER BY kelas.ID_KELAS DESC");
    }
} else {
    $kelas = tampel("SELECT kelas.ID_KELAS, kelas.nama_kelas, kelas.jenjang_kelas, kelas.ID_GURU, guru.username as pengajar FROM kelas INNER JOIN guru ON kelas.ID_GURU = guru.ID_GURU WHERE guru.ID_GURU = kelas.ID_GURU ORDER BY kelas.ID_KELAS DESC");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Kelas</title>
    <link rel="stylesheet" href="tambahdata.css">
</head>

<body>
    <main>
        <div class="container">
            <form action="" method="post" class="search-form">
                <input type="text" name="keyword" placeholder="Cari Apa?" autocomplete="off" autofocus>
                <select name="jenis">
                    <option value="">Semua Jenjang</option>
                    <option value="10 IPA">10 IPA</option>
                    <option value="10 IPS">10 IPS</option>
                </select>
                <button type="submit" name="cari"><i class="fa fa-search"></i><span>Search</span></button>
            </form>
            <div class="table-container">
                <table>
                    <tr>
                        <th>ID Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Jenjang Kelas</th>
                        <th>ID Guru</th>
                        <?php if (isset($_POST["cari"]) && $_POST["jenis"] != "") { ?>
                            <th>Pengajar</th>
                        <?php } ?>
                    </tr>
                    <?php
                    foreach ($kelas as $m) {
                        $id = $m["ID_KELAS"];
                        $judul = $m["nama_kelas"];
                        $jenis = $m["jenjang_kelas"];
                        $id_guru = $m["ID_GURU"];
                        $pengajar = isset($m["pengajar"]) ? $m["pengajar"] : null;

                        // Tampilkan data kelas
                        echo "<tr>";
                        echo "<td><a href='tambahdata.php?id={$id}'>{$id}</a></td>";
                        echo "<td><a href='tambahdata.php?id={$id}'>{$judul}</a></td>";
                        echo "<td><a href='tambahdata.php?id={$id}'>{$jenis}</a></td>";
                        echo "<td><a href='tambahdata.php?id={$id}'>{$id_guru}</a></td>";
                        if (isset($_POST["cari"]) && $_POST["jenis"] != "") {
                            echo "<td><a href='tambahdata.php?id={$id}'>{$pengajar}</a></td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tambah-materi">
                <a href="tambahkelas.php"><i class="fas fa-plus"></i>Belum Memiliki Kelas<br> Ayo Tambah Kelas</a>
            </div>
        </div>
    </main>
</body>

</html>