<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<header>
    <nav class="navbar">
        <div class="logo">Recipist</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
            <?php else: ?>
                <li><a href="registration.php">Sign up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
