<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

$id = intval($_GET['id']);

$data = mysqli_query($conn,"SELECT * FROM testimoni WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if($row){

    if($row['foto'] != "" && file_exists("../../assets/img/testimoni/".$row['foto'])){
        unlink("../../assets/img/testimoni/".$row['foto']);
    }

    mysqli_query($conn,"DELETE FROM testimoni WHERE id='$id'");
}

header("Location:index.php");
exit;