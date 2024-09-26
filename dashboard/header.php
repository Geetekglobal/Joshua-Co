<?php
include('connect.php');

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Joshuaco" name="keywords">
    <meta content="JOSHUACO" name="description">

    <!-- Template Stylesheet -->
    <link href="style.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://js.paystack.co/v1/inline.js"></script>


</head>
<body>
<header class="header">
    <div class="logo">
        <img src="../img/logo-white.png" alt="Joshuaco Logo">
    </div>
    <div>
    <div class="menu-icon" onclick="toggleNav()">&#9776;</div> <!-- Menu icon for mobile -->
    <nav id="nav-menu">
        <a href="dashboard.php">Home</a>
        <a href="mytrainings.php">Trainings</a>
        <a href="courses.php">Videos</a>
        <a href="logout.php" class="logout-btn">Log out</a>
    </nav>
    </div>
</header>

<script>
    function toggleNav() {
        const nav = document.getElementById('nav-menu');
        nav.classList.toggle('show');
    }
</script>

