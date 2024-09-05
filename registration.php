<?php
include './dao/database.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

 
    $stmt = $conn->prepare("INSERT INTO users (name, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $username, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        // Redirect to sign in page
        header("Location: signin.php");
        exit();
    } else {
        $error_message = 'Failed to register user. Please try again later.';
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

<body id="registration">
    
    <main class="content">
        <div class="registration-container">
            <h2>SIGN UP</h2>
            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form class="registration-form" method="post" action="registration.php">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name">
                    <span id="name-error" class="error-message"></span>
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                    <span id="username-error" class="error-message"></span>
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email">
                    <span id="email-error" class="error-message"></span>
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number">
                    <span id="phone-error" class="error-message"></span>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <span id="password-error" class="error-message"></span>
                </div>
                <div>
                    <label for="password2">Retype your password</label>
                    <input type="password" id="password2" name="password2">
                    <span id="password2-error" class="error-message"></span>
                </div>
                <div>
                    <input type="checkbox" id="agree" name="agree">
                    <label for="agree">I agree to the above information</label><br>
                    <span id="agree-error" class="error-message"></span>
                </div>
                <div>
                    <input type="submit" value="Send" name="submit-signup" id="submit-signup">
                    <input type="reset" value="Reset" name="Reset">
                </div>
                <div>
                    <a href="signin.php">Already have an account?</a>
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

    <script src="./scripts/registration.js"></script>

</body>

</html>
