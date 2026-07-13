<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

$id = intval($_GET['id']);

$data = mysqli_query($conn,"SELECT * FROM testimoni WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(!$row){
    die("Data tidak ditemukan.");
}

if(isset($_POST['simpan'])){

    $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
    $pekerjaan  = mysqli_real_escape_string($conn,$_POST['pekerjaan']);
    $komentar   = mysqli_real_escape_string($conn,$_POST['komentar']);
    $rating     = intval($_POST['rating']);

    $foto = $row['foto'];

    if($_FILES['foto']['name']!=""){

        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp,"../../assets/img/testimoni/".$foto);

    }

    mysqli_query($conn,"
    UPDATE testimoni
    SET
        nama='$nama',
        pekerjaan='$pekerjaan',
        komentar='$komentar',
        rating='$rating',
        foto='$foto'
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
<title>Edit Testimoni</title>

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

img{
width:90px;
border-radius:50%;
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

<h2>Edit Testimoni</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama</label>

<input
type="text"
name="nama"
value="<?= $row['nama']; ?>"
required>

<label>Pekerjaan</label>

<input
type="text"
name="pekerjaan"
value="<?= $row['pekerjaan']; ?>"
required>

<label>Komentar</label>

<textarea
name="komentar"
required><?= $row['komentar']; ?></textarea>

<label>Rating</label>

<select name="rating">

<option value="5" <?= $row['rating']==5?'selected':''; ?>>⭐⭐⭐⭐⭐</option>
<option value="4" <?= $row['rating']==4?'selected':''; ?>>⭐⭐⭐⭐</option>
<option value="3" <?= $row['rating']==3?'selected':''; ?>>⭐⭐⭐</option>
<option value="2" <?= $row['rating']==2?'selected':''; ?>>⭐⭐</option>
<option value="1" <?= $row['rating']==1?'selected':''; ?>>⭐</option>

</select>

<label>Foto Saat Ini</label><br>

<img src="../../assets/img/testimoni/<?= $row['foto']; ?>">

<label>Ganti Foto (Opsional)</label>

<input
type="file"
name="foto"
accept="image/*">

<button
type="submit"
name="simpan">

Update Testimoni

</button>

</form>

</div>

</body>
</html>