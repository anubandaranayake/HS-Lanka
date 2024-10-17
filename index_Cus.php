<?php
// Start the session to handle user login state
session_start();

// Include the database connection
require_once './Db/connection.php';

// Example: Check if user is logged in
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Your Website Name</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="./Css/home.Css">
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="Home.php"><img src="./Images/logo/logo.png" alt="Logo"></a>
        </div>
        <ul class="navbar-links">
            <li><a href="Home.php">Home</a></li>
            <li><a href="Beautyproducts.php">Beauty Products</a></li>
            <li><a href="Electronics.php">Electronics</a></li>
            <li><a href="Homeandliving.php">Home and Living</a></li>
            <li><a href="WatchesandBags.php">Watches and Bags</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
            <li><a href="Login.php">Login</a></li>
        </ul>
        <div class="navbar-icons">
            <?php if ($isLoggedIn): ?>
                <a href="profile.php" title="Profile"><i class="fas fa-user-circle"></i></a>
            <?php else: ?>
                <a href="login.php" title="Login"><i class="fas fa-sign-in-alt"></i></a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Icons Section -->
    <div class="top-icons">
        <a href="Search.php" title="Search"><i class="fas fa-search"></i></a>
        <a href="Cart.php" title="Cart"><i class="fas fa-shopping-cart"></i></a>
        <a href="Wishlist.php" title="Wishlist"><i class="fas fa-heart"></i></a>
    </div>