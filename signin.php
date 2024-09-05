<?php
session_start();
include './dao/database.php';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid username or password
        $error_message = 'Invalid username or password.';
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Manager</title>
    <link rel="stylesheet" href="./css/recipe.css">
</head>

<body id="signin">
    <header>
        <nav class="navbar">
            <div class="logo">Recipist</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="registration.php">Sign up</a></li>
            </ul>
        </nav>
    </header>
    <main class="content">
        <div class="registration-container">
            <h2>SIGN IN</h2>
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form class="registration-form" method="post" action="signin.php">
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                    <span id="username-error" class="error-message"></span>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                    <span id="password-error" class="error-message"></span>
                </div>
                <div>
                    <input type="submit" value="Send" name="submit-signin" id="submit-signin">
                    <input type="reset" value="Reset" name="Reset">
                </div>
            </form>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content text-center">
            <h5> 
                Copyright © 2024 All rights reserved
            </h5> 
        </div>
    </footer>

    <script src="./scripts/signin.js"></script>

</body>

</html>
