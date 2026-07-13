<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

$query = mysqli_query($conn,"SELECT * FROM testimoni ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Testimoni</title>

<style>

body{
font-family:Arial;
background:#f5f6fa;
padding:30px;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.btn{
background:#2563eb;
color:white;
padding:10px 18px;
text-decoration:none;
border-radius:6px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

th,td{
padding:12px;
border:1px solid #ddd;
text-align:left;
}

th{
background:#1e293b;
color:white;
}

.edit{
background:#f59e0b;
color:white;
padding:6px 10px;
text-decoration:none;
border-radius:5px;
}

.hapus{
background:#dc2626;
color:white;
padding:6px 10px;
text-decoration:none;
border-radius:5px;
}

</style>

</head>

<body>

<div class="header">

<h2>Kelola Testimoni</h2>

<a href="tambah.php" class="btn">

+ Tambah Testimoni

</a>

</div>

<table>

<tr>

<th>No</th>
<th>Nama</th>
<th>Komentar</th>
<th>Bintang</th>
<th>Aksi</th>

</tr>

<?php
$no=1;

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?php echo $row['nama']; ?></td>

<td><?php echo $row['komentar']; ?></td>

<td><?php echo str_repeat("⭐", (int)$row['rating']); ?></td>

<td>

<a class="edit"
href="edit.php?id=<?= $row['id']; ?>">
Edit
</a>

<a class="hapus"
onclick="return confirm('Hapus testimoni ini?')"
href="hapus.php?id=<?= $row['id']; ?>">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>