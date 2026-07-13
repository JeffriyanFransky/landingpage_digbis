<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: /arelunaatelier/admin/admin.php");
    exit;
}
?>