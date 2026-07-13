<?php
require_once "../../config/auth.php";
require_once "../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Produk</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f5f6fa;
padding:30px;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.header h2{
font-size:28px;
}

.btn{
background:#2563eb;
color:white;
padding:10px 18px;
text-decoration:none;
border-radius:8px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

th,td{
padding:14px;
border-bottom:1px solid #ddd;
text-align:left;
}

th{
background:#1e293b;
color:white;
}

img{
width:80px;
height:80px;
object-fit:cover;
border-radius:8px;
}

.edit{
background:#f59e0b;
color:white;
padding:6px 12px;
text-decoration:none;
border-radius:5px;
margin-right:5px;
}

.hapus{
background:#dc2626;
color:white;
padding:6px 12px;
text-decoration:none;
border-radius:5px;
}

.kembali{
display:inline-block;
margin-top:20px;
text-decoration:none;
}

</style>

</head>

<body>

<div class="header">

<h2>Kelola Produk</h2>

<a href="tambah.php" class="btn">
+ Tambah Produk
</a>

</div>

<table>

<tr>

<th>No</th>

<th>Gambar</th>

<th>Nama</th>

<th>Harga</th>

<th>Seller</th>

<th>Aksi</th>

</tr>

<?php
$no=1;

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td>
<img src="../../<?= $row['gambar']; ?>">
</td>

<td><?= $row['nama']; ?></td>

<td><?= $row['harga']; ?></td>

<td><?= $row['seller']; ?></td>

<td>

<a
class="edit"
href="edit.php?id=<?= $row['id']; ?>">
Edit
</a>

<a
class="hapus"
onclick="return confirm('Yakin ingin menghapus produk ini?')"
href="hapus.php?id=<?= $row['id']; ?>">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

<a
class="kembali"
href="../dashboard.php">
← Kembali ke Dashboard
</a>

</body>
</html>