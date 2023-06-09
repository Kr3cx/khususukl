<?php

include 'sambung.php';
if (isset($_GET['deleteid_siswa'])) {
    $id = $_GET['deleteid_siswa'];
    $sql = "delete from `siswa` where ID_SISWA= $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('location:viewtable2.php');
    } else {
        die(mysqli_error($conn));
    }
}

?>