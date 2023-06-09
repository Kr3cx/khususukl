<?php
// isi nama host, username mysql, dan ppassword mysql 
$databaseHost = "localhost";
$databaseName = "matyuk";
$databaseUsername = "root";
$databasePassword = "";

$db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

function tampil($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];

    while ($data = mysqli_fetch_assoc($result)) {
        $rows[] = $data;
    }

    return $rows;
}


function CariK($keyword)
{
    global $db;
    $query = mysqli_query($db, "SELECT * FROM materi where judul_materi LIKE '%$keyword%' OR jenis_materi like '%$keyword%'");

    return $query;

}

?>