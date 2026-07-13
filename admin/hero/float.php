<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

$query = mysqli_query($conn,"SELECT * FROM hero_float ORDER BY id ASC");

if(isset($_POST['simpan'])){

    foreach($_POST['judul'] as $id=>$judul){

        $judul = mysqli_real_escape_string($conn,$judul);
        $isi   = mysqli_real_escape_string($conn,$_POST['isi'][$id]);

        mysqli_query($conn,"
        UPDATE hero_float
        SET
            judul='$judul',
            isi='$isi'
        WHERE id='$id'
        ");

    }

    header("Location: float.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Hero Float</title>

<style>

body{
font-family:Arial;
background:#f5f6fa;
padding:40px;
}

.box{
max-width:800px;
margin:auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.item{
border:1px solid #ddd;
padding:20px;
margin-bottom:20px;
border-radius:10px;
}

input{
width:100%;
padding:12px;
margin-top:8px;
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

.back{
display:inline-block;
margin-left:10px;
text-decoration:none;
}

</style>

</head>

<body>

<div class="box">

<h2>Kelola Hero Float</h2>

<form method="POST">

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<div class="item">

<label>Judul</label>

<input
type="text"
name="judul[<?= $row['id']; ?>]"
value="<?= htmlspecialchars($row['judul']); ?>">

<label>Isi</label>

<input
type="text"
name="isi[<?= $row['id']; ?>]"
value="<?= htmlspecialchars($row['isi']); ?>">

</div>

<?php } ?>

<button
type="submit"
name="simpan">

Simpan Perubahan

</button>

<a
class="back"
href="index.php">

Kembali

</a>

</form>

</div>

</body>
</html>