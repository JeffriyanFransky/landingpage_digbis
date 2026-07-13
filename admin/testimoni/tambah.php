<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

if(isset($_POST['simpan'])){

    $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
    $pekerjaan  = mysqli_real_escape_string($conn,$_POST['pekerjaan']);
    $komentar   = mysqli_real_escape_string($conn,$_POST['komentar']);
    $rating     = intval($_POST['rating']);

    $foto = "";

    if($_FILES['foto']['name'] != ""){

        $foto = time()."_".$_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp,"../../uploads/testimoni/".$foto);

    }

    mysqli_query($conn,"
        INSERT INTO testimoni
        (nama, pekerjaan, komentar, rating, foto)
        VALUES
        ('$nama','$pekerjaan','$komentar','$rating','$foto')
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Tambah Testimoni</title>

<style>

body{
font-family:Arial;
background:#f5f6fa;
padding:40px;
}

.box{
max-width:650px;
margin:auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

input,
textarea,
select{
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
border-radius:6px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="box">

<h2>Tambah Testimoni</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama</label>

<input
type="text"
name="nama"
required>

<label>Pekerjaan</label>

<input
type="text"
name="pekerjaan"
required>

<label>Komentar</label>

<textarea
name="komentar"
required></textarea>

<label>Rating</label>

<select name="rating">

<option value="5">⭐⭐⭐⭐⭐ (5)</option>
<option value="4">⭐⭐⭐⭐ (4)</option>
<option value="3">⭐⭐⭐ (3)</option>
<option value="2">⭐⭐ (2)</option>
<option value="1">⭐ (1)</option>

</select>

<label>Foto</label>

<input
type="file"
name="foto"
accept="image/*">

<button
type="submit"
name="simpan">

Simpan Testimoni

</button>

</form>

</div>

</body>
</html>