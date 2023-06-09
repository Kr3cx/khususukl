<?php
// isi nama host, username mysql, dan ppassword mysql 
$databaseHost = "localhost";
$databaseName = "matyuk";
$databaseUsername = "root";
$databasePassword = "";

$db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);



function tampel($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];

    while ($data = mysqli_fetch_assoc($result)) {
        $rows[] = $data;
    }

    return $rows;
}

function golek($keyword)
{
    global $db;
    $query = mysqli_query($db, "SELECT * FROM kelas where nama_kelas LIKE '%$keyword%' OR jenjang_kelas like '%$keyword%'");

    return $query;

}

?>