<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";

// Hitung data
$totalProduk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produk"));
$totalTestimoni = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM testimoni"));
$totalHeroCard = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hero_card"));
$totalHeroFloat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hero_float"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin - ArelunaAtelier</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
display:flex;
background:#f5f6fa;
}

.sidebar{
width:250px;
height:100vh;
background:#1e293b;
color:white;
position:fixed;
left:0;
top:0;
padding:25px;
}

.sidebar h2{
margin-bottom:40px;
font-size:22px;
}

.sidebar a{
display:block;
padding:14px 18px;
margin-bottom:10px;
text-decoration:none;
color:white;
border-radius:8px;
transition:.3s;
}

.sidebar a:hover{
background:#334155;
}

.content{
margin-left:250px;
padding:30px;
width:100%;
}

.title{
font-size:28px;
font-weight:600;
margin-bottom:25px;
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.card{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.card h3{
font-size:16px;
color:#666;
margin-bottom:10px;
}

.card p{
font-size:34px;
font-weight:bold;
color:#111827;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>Areluna Admin</h2>

<a href="dashboard.php">🏠 Dashboard</a>
<a href="hero/index.php">🖼 Hero Section</a>
<a href="produk/index.php">📦 Kelola Produk</a>
<a href="testimoni/index.php">💬 Kelola Testimoni</a>
<a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

<div class="title">
Dashboard
</div>

<div class="cards">

<div class="card">
<h3>Total Produk</h3>
<p><?= $totalProduk ?></p>
</div>

<div class="card">
<h3>Total Testimoni</h3>
<p><?= $totalTestimoni ?></p>
</div>

<div class="card">
<h3>Hero Card</h3>
<p><?= $totalHeroCard ?></p>
</div>

<div class="card">
<h3>Hero Float</h3>
<p><?= $totalHeroFloat ?></p>
</div>

</div>

</div>

</body>
</html>