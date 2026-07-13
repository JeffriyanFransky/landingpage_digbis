<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

$query = mysqli_query($conn,"SELECT * FROM hero_card LIMIT 1");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $nama_produk = mysqli_real_escape_string($conn,$_POST['nama_produk']);
    $seller      = mysqli_real_escape_string($conn,$_POST['seller']);
    $harga       = mysqli_real_escape_string($conn,$_POST['harga']);
    $kategori    = mysqli_real_escape_string($conn,$_POST['kategori']);

    if($_FILES['gambar']['name']!=""){

        $namaFile = time()."_".basename($_FILES['gambar']['name']);
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp,"../../uploads/produk/".$namaFile);

        if(!empty($data['gambar'])){

            $lama="../../".$data['gambar'];

            if(file_exists($lama)){
                unlink($lama);
            }

        }

        $gambar="uploads/produk/".$namaFile;

    }else{

        $gambar=$data['gambar'];

    }

    mysqli_query($conn,"UPDATE hero_card SET

        nama_produk='$nama_produk',
        seller='$seller',
        harga='$harga',
        kategori='$kategori',
        gambar='$gambar'

        WHERE id=".$data['id']);

    header("Location:index.php");
    exit;

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Hero Card</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f5f6fa;
padding:40px;
}

.box{

max-width:750px;
margin:auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,.08);

}

h2{

margin-bottom:25px;

}

input{

width:100%;
padding:12px;
margin-bottom:15px;

}

button{

padding:12px 22px;
background:#2563eb;
border:none;
color:white;
cursor:pointer;
border-radius:6px;

}

img{

width:180px;
border-radius:10px;
margin-bottom:15px;

}

.back{

display:inline-block;
margin-top:20px;
text-decoration:none;

}

</style>

</head>

<body>

<div class="box">

<h2>Edit Hero Card</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama Produk</label>

<input
type="text"
name="nama_produk"
value="<?= htmlspecialchars($data['nama_produk']) ?>"
required>

<label>Seller</label>

<input
type="text"
name="seller"
value="<?= htmlspecialchars($data['seller']) ?>"
required>

<label>Harga</label>

<input
type="text"
name="harga"
value="<?= htmlspecialchars($data['harga']) ?>"
required>

<label>Kategori</label>

<input
type="text"
name="kategori"
value="<?= htmlspecialchars($data['kategori']) ?>"
required>

<label>Gambar Saat Ini</label>

<br><br>

<img src="../../<?= $data['gambar']; ?>">

<br><br>

<label>Upload Gambar Baru</label>

<input
type="file"
name="gambar"
accept="image/*">

<button type="submit" name="update">
Update Hero
</button>

</form>

<br><br>

<a href="float.php"
style="
display:inline-block;
padding:12px 20px;
background:#10b981;
color:white;
text-decoration:none;
border-radius:6px;
margin-right:10px;
">
Kelola Hero Float
</a>

<a class="back" href="../dashboard.php">
← Kembali ke Dashboard
</a>

</div>

</body>

</html>