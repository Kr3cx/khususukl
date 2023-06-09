<?php
require "koneksi.php";

$materi = tampil("SELECT * FROM materi ORDER BY ID_MATERI DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Materi</title>
    <link rel="stylesheet" href="tampilmateri.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Judul Materi</th>
                            <th>Jenis Materi</th>
                            <th>Isi Materi</th>
                            <th>Tanggal</th>
                            <th>File Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($materi as $m) {
                            $id = $m["ID_MATERI"];
                            $judul = $m["judul_materi"];
                            $jenis = $m["jenis_materi"];
                            $isi = $m["isi_materi"];
                            $tanggal = $m["tanggal"];
                            $file = $m["file_dokumen"];

                            // Tampilkan data materi
                            echo "<tr>";
                            echo "<td>{$judul}</td>";
                            echo "<td>{$jenis}</td>";
                            echo "<td>{$isi}</td>";
                            echo "<td>{$tanggal}</td>";
                            echo "<td><a href='uploads/{$file}' download>Tautan Unduh</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>