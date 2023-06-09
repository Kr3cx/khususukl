<?php
require "koneksi.php";

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $jenis = $_POST["jenis"];
    if ($jenis == "") {
        $materi = Carik($keyword);
    } else {
        $materi = tampil("SELECT * FROM materi WHERE jenis_materi='$jenis' AND judul_materi LIKE '%$keyword%' ORDER BY ID_MATERI DESC");
    }
} else {
    $materi = tampil("SELECT * FROM materi ORDER BY ID_MATERI DESC");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Classroom</title>
    <link rel="stylesheet" href="tambahdata.css">
</head>
<header>
    <h1 class="title">MATYUK</h1>
    <br>
    <hr>
    <nav id="navigation">
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="landingpage.php">Kelas</a></li>
            <li><a href="homepage.php?page=logout" onclick="return confirmLogout()">Logout</a></li>
        </ul>
    </nav>
</header>

<body>
    <main>
        <div class="container">
            <form action="" method="post" class="search-form">
                <input type="text" name="keyword" placeholder="Cari Materi Apa?" autocomplete="off" autofocus>
                <select name="jenis">
                    <option value="">Semua Jenis Materi</option>
                    <option value="LOGARITMA">LOGARITMA</option>
                    <option value="ALJABAR">ALJABAR</option>
                    <option value="VEKTOR">VEKTOR</option>
                    <option value="EKSPONEN">EKSPONEN</option>
                </select>
                <button type="submit" name="cari"><i class="fa fa-search"></i><span>Search</span></button>
            </form>
            <div class="table-container">
                <table>
                    <!-- Modify the loop that generates the table rows -->
                    <!-- Modify the loop that generates the table rows -->
                    <?php
                    $prev_judul = null;
                    echo "<div class='card'>"; // New line: Open the first card div
                    foreach ($materi as $m) {
                        $id = $m["ID_MATERI"];
                        $judul = $m["judul_materi"];
                        $jenis = $m["jenis_materi"];
                        $tanggal = $m["tanggal"];

                        // Cek apakah judul materi sama dengan baris sebelumnya
                        if ($judul != $prev_judul) {
                            // Jika tidak sama, buat card baru
                            if ($prev_judul != null) {
                                echo "</div>"; // Close the previous card div
                            }
                            $prev_judul = $judul;
                            echo "<div class='card'>"; // Open a new card div
                        }

                        // Tampilkan data materi
                        echo "<div class='table-row'>";
                        echo "<div class='table-cell'>{$id}</div>";
                        echo "<div class='table-cell'>{$judul}</div>";
                        echo "<div class='table-cell'>{$jenis}</div>";
                        echo "<div class='table-cell'>{$tanggal}</div>";
                        echo "<div class='table-cell'><a href='delete2.php?id={$id}'>Delete</a> | <a href='edit2.php?id={$id}'>Edit</a></div>";
                        echo "</div>";
                    }
                    echo "</div>"; // Close the last card div
                    ?>
                </table>
            </div>
            <div class="tambah-materi">
                <a href="nambahdata1.php"><i class="fas fa-plus"></i>Tambah Materi</a>
            </div>
        </div>
    </main>
    <br><br><br><br><br><br><br><br><br><br><br>
    <hr>
    <footer>
        &copy Hak Cipta PT. MAT YUK 2030 | Web E-Learning by @kr1cx <br><br> Website E LEARNING MATEMATIKA INDONESIA,
        <br> BETA TESTING. <br><br><br><br>
    </footer>


</body>

</html>