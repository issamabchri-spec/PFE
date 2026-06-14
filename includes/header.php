<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav>
    <a href="../user/index.php">HOME</a>
    <a href="../user/index.php#menu">MENU</a>
    <a href="../user/cart.php">CART 🛒 <span>0</span></a>
    
    <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
        <a href="../admin/dashboard.php">DASHBOARD</a>
        <a href="../auth/logout.php">LOGOUT</a>
    <?php endif; ?>
</nav>