<html lang="en">

<head>
    <title>MatYuk</title>
    <meta charset="UTF-8">
    <meta name="description" contents="Kuliner Sukodono">
    <link rel="stylesheet" href="landingpage.css">
</head>

<body>
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
    <div id="contents">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
                case 'logout':
                    include "logout.php";
                    break;
            }
        } else {
            include "kelas.php";
        }
        ?>


    </div>
    <script>
        function confirmLogout() {
            var confirmation = confirm("Apakah Anda yakin ingin logout?");
            if (confirmation) {
                window.location.href = "logout.php";
            } else {
                return false;
            }
        }
    </script>
    <br><br><br><br><br><br><br><br><br><br><br>
    <hr>
    <footer>
        &copy Hak Cipta PT. MAT YUK 2030 | Web E-Learning by @kr1cx <br><br> Website E LEARNING MATEMATIKA INDONESIA,
        <br> BETA TESTING. <br><br><br><br>
    </footer>


</body>

</html>


<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: formlogin.php');
    exit();
}
?>