<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

if(isset($_POST['simpan'])){

    $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
    $kategori   = mysqli_real_escape_string($conn,$_POST['kategori']);
    $seller     = mysqli_real_escape_string($conn,$_POST['seller']);
    $harga      = mysqli_real_escape_string($conn,$_POST['harga']);
    $badge      = mysqli_real_escape_string($conn,$_POST['badge']);
    $deskripsi  = mysqli_real_escape_string($conn,$_POST['deskripsi']);
    $status     = $_POST['status'];

    $namaFile = time()."_".$_FILES['gambar']['name'];
    $tmp      = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp,"../../uploads/produk/".$namaFile);

    $gambar = "uploads/produk/".$namaFile;

    mysqli_query($conn,"INSERT INTO produk
    (nama,kategori,seller,harga,badge,deskripsi,gambar,status)
    VALUES
    ('$nama','$kategori','$seller','$harga','$badge','$deskripsi','$gambar','$status')");

    header("Location:index.php");
    exit;

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Tambah Produk</title>

<style>

body{
font-family:Arial;
background:#f5f6fa;
padding:40px;
}

.box{
background:white;
max-width:700px;
margin:auto;
padding:30px;
border-radius:12px;
box-shadow:0 10px 20px rgba(0,0,0,.08);
}

input,textarea,select{

width:100%;
padding:12px;
margin-bottom:15px;

}

textarea{

height:120px;

}

button{

padding:12px 20px;
background:#2563eb;
color:white;
border:none;
cursor:pointer;
border-radius:6px;

}

a{

text-decoration:none;

}

</style>

</head>

<body>

<div class="box">

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama Produk</label>
<input type="text" name="nama" required>

<label>Kategori</label>
<input type="text" name="kategori" required>

<label>Seller</label>
<input type="text" name="seller" required>

<label>Harga</label>
<input type="text" name="harga" required>

<label>Badge</label>
<input type="text" name="badge" required>

<label>Deskripsi</label>
<textarea name="deskripsi" required></textarea>

<label>Upload Gambar</label>
<input type="file" name="gambar" accept="image/*" required>

<label>Status</label>

<select name="status">

<option value="Aktif">Aktif</option>

<option value="Nonaktif">Nonaktif</option>

</select>

<button type="submit" name="simpan">

Simpan Produk

</button>

</form>

</div>

</body>
</html>