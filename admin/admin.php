<?php
session_start();
include "../config/koneksi.php";

if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($query)>0){

        $_SESSION['login'] = true;

        header("Location: dashboard.php");
        exit;

    }else{

        $error = "Username atau Password Salah";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Login Admin</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f5f5f5;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
width:360px;
background:#fff;
padding:30px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,.1);
}

h2{
text-align:center;
margin-bottom:20px;
}

input{
width:100%;
padding:12px;
margin-bottom:15px;
}

button{
width:100%;
padding:12px;
background:#111827;
color:white;
border:none;
cursor:pointer;
}

.error{
color:red;
margin-bottom:15px;
text-align:center;
}

</style>

</head>

<body>

<div class="box">

<h2>Areluna Admin</h2>

<?php if(isset($error)){ ?>
<div class="error"><?= $error; ?></div>
<?php } ?>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">

LOGIN

</button>

</form>

</div>

</body>
</html>