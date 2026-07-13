<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
    $kategori   = mysqli_real_escape_string($conn,$_POST['kategori']);
    $seller     = mysqli_real_escape_string($conn,$_POST['seller']);
    $harga      = mysqli_real_escape_string($conn,$_POST['harga']);
    $badge      = mysqli_real_escape_string($conn,$_POST['badge']);
    $deskripsi  = mysqli_real_escape_string($conn,$_POST['deskripsi']);
    $status     = $_POST['status'];

    // Jika upload gambar baru
    if($_FILES['gambar']['name'] != ""){

        $namaFile = time()."_".$_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        $folder = "../../uploads/produk/";

        $namaFile = time()."_".basename($_FILES['gambar']['name']);
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp, $folder.$namaFile);

        // Hapus gambar lama (jika memang ada)
        if(!empty($data['gambar'])){

            $gambarLama = "../../".$data['gambar'];

            if(file_exists($gambarLama)){
                unlink($gambarLama);
            }

        }

$gambar = "uploads/produk/".$namaFile;

    }else{

        $gambar = $data['gambar'];

    }

    mysqli_query($conn,"UPDATE produk SET

        nama='$nama',
        kategori='$kategori',
        seller='$seller',
        harga='$harga',
        badge='$badge',
        deskripsi='$deskripsi',
        gambar='$gambar',
        status='$status'

        WHERE id='$id'

    ");

    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Produk</title>

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
box-shadow:0 8px 20px rgba(0,0,0,.08);
}

input,textarea,select{
width:100%;
padding:12px;
margin-bottom:15px;
}

textarea{
height:120px;
}

img{
width:150px;
border-radius:10px;
margin-bottom:15px;
}

button{
padding:12px 20px;
background:#2563eb;
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="box">

<h2>Edit Produk</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama Produk</label>
<input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

<label>Kategori</label>
<input type="text" name="kategori" value="<?= htmlspecialchars($data['kategori']) ?>" required>

<label>Seller</label>
<input type="text" name="seller" value="<?= htmlspecialchars($data['seller']) ?>" required>

<label>Harga</label>
<input type="text" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" required>

<label>Badge</label>
<input type="text" name="badge" value="<?= htmlspecialchars($data['badge']) ?>" required>

<label>Deskripsi</label>
<textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>

<label>Gambar Saat Ini</label><br>

<img src="../../<?= $data['gambar']; ?>">

<label>Upload Gambar Baru (Opsional)</label>

<input type="file" name="gambar" accept="image/*">

<label>Status</label>

<select name="status">

<option value="Aktif" <?= $data['status']=="Aktif"?"selected":"" ?>>Aktif</option>

<option value="Nonaktif" <?= $data['status']=="Nonaktif"?"selected":"" ?>>Nonaktif</option>

</select>

<button type="submit" name="update">

Update Produk

</button>

</form>

</div>

</body>
</html>