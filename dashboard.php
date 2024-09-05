<?php
include './dao/database.php';
session_start();

// check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/recipe.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Recipist</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main class="content">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    </main>
    <footer class="footer">
        <div class="footer-content text-center">
            <h5>Copyright © 2024 All rights reserved</h5>
        </div>
    </footer>
</body>
</html>
