<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

if(!isset($_GET['id'])){
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data produk
$query = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");

if(mysqli_num_rows($query)==0){
    header("Location:index.php");
    exit;
}

$data = mysqli_fetch_assoc($query);

// Hapus gambar jika ada
if(!empty($data['gambar'])){

    $file = "../../".$data['gambar'];

    if(file_exists($file)){
        unlink($file);
    }

}

// Hapus data dari database
mysqli_query($conn,"DELETE FROM produk WHERE id='$id'");

header("Location:index.php");
exit;
?>