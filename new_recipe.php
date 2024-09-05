<?php
include './dao/database.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $title = trim($_POST['new-title']);
    $description = trim($_POST['new-description']);
    $totalTime = trim($_POST['total-time']);
    $cuisine = trim($_POST['cuisine']);
    $dietaryPreference = trim($_POST['dietary-preference']);
    $ingredients = trim($_POST['ingredients']);
    $steps = trim($_POST['steps']);
    $imageFileName = '';

    // get the logged-in user's ID
    $createdBy = $_SESSION['user_id']; 

    if (isset($_FILES['recipe-image']) && $_FILES['recipe-image']['error'] == 0) {
        $fileName = $_FILES['recipe-image']['name'];
        $imageFileName = uniqid() . '_' . $fileName;
        move_uploaded_file($_FILES['recipe-image']['tmp_name'], "uploads/" . $imageFileName);
    }

    if (empty($errors)) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $port = 3308; // Specify the port number here
        $dbname = "recipe_manager"; // Define the database name

        // create connection
        $conn = new mysqli($servername, $username, $password, $dbname, $port);

        // check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO recipes (title, description, total_time, cuisine, dietary_preference, ingredients, steps, image, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssssi", $title, $description, $totalTime, $cuisine, $dietaryPreference, $ingredients, $steps, $imageFileName, $createdBy);

        if ($stmt->execute()) {
            echo "New recipe created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
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
<body id="new_recipe">
    <main class="content-recipe">
        <div class="background">
            <div class="intro">
                <h2>"Let's build a diverse library of healthy recipes together!"</h2>
            </div>
            <div class="form-container">
                <br><br><br><br>
                <h2>Create new recipe</h2>
                <form class="recipe-form" method="post" action="new_recipe.php" enctype="multipart/form-data">
                    <div>
                        <label for="new-title">Title</label><br>
                        <input type="text" class="form-input" id="new-title" name="new-title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>"><br>
                        <span id="title-error" class="error-message"><?php echo isset($errors['title']) ? $errors['title'] : ''; ?></span>
                    </div>

                    <div>
                        <label for="new-description">Description</label><br>
                        <input type="text" class="form-input" id="new-description" name="new-description" value="<?php echo isset($description) ? htmlspecialchars($description) : ''; ?>"><br>
                        <span id="description-error" class="error-message"><?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                    </div>

                    <div>
                        <label for="total-time">Total time</label><br>
                        <input type="text" class="form-input" id="total-time" name="total-time" value="<?php echo isset($totalTime) ? htmlspecialchars($totalTime) : ''; ?>"><br>
                        <span id="total-time-error" class="error-message"><?php echo isset($errors['totalTime']) ? $errors['totalTime'] : ''; ?></span>
                    </div>

                    <div>
                        <label for="cuisine">Cuisine</label><br>
                        <input type="text" class="form-input" id="cuisine" name="cuisine" value="<?php echo isset($cuisine) ? htmlspecialchars($cuisine) : ''; ?>"><br>
                        <span id="cuisine-error" class="error-message"><?php echo isset($errors['cuisine']) ? $errors['cuisine'] : ''; ?></span>
                    </div>

                    <div>
                        <label for="dietary-preference">Dietary Preference</label><br>
                        <input type="text" class="form-input" id="dietary-preference" name="dietary-preference" value="<?php echo isset($dietaryPreference) ? htmlspecialchars($dietaryPreference) : ''; ?>"><br>
                        <span id="dietary-preference-error" class="error-message"><?php echo isset($errors['dietaryPreference']) ? $errors['dietaryPreference'] : ''; ?></span>
                    </div>

                    <div id="ingredients-list">
                        <label for="ingredients">Ingredients</label><br>
                        <textarea class="form-input" id="ingredients" name="ingredients" rows="6" cols="5"><?php echo isset($ingredients) ? htmlspecialchars($ingredients) : ''; ?></textarea><br>
                        <span id="ingredients-error" class="error-message"><?php echo isset($errors['ingredients']) ? $errors['ingredients'] : ''; ?></span>
                    </div>

                    <div id="preparation-list">
                        <label for="steps">Steps</label><br>
                        <textarea class="form-input" id="steps" name="steps" rows="6" cols="5"><?php echo isset($steps) ? htmlspecialchars($steps) : ''; ?></textarea><br>
                        <span id="preparation-error" class="error-message"><?php echo isset($errors['steps']) ? $errors['steps'] : ''; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="recipe-image">Select an image</label>
                        <input type="file" id="recipe-image" name="recipe-image">
                        <span id="recipe-image-error" class="error-message"><?php echo isset($errors['recipeImage']) ? $errors['recipeImage'] : ''; ?></span>
                    </div>

                    <div id="recipe-buttons">
                        <input type="submit" value="Save" name="submit-recipe" id="submit-recipe">
                        <input type="reset" value="Reset" name="Reset">
                    </div>
                    <br><br><br>
                </form>
            </div>
        </div>
        
        <script src="./scripts/new_recipe.js"></script>

    </main>
    <footer class="footer">
        <div class="footer-content text-center">
            <h5>  
                Copyright © 2024 All rights reserved
            </h5> 
        </div>
    </footer>
</body>
</html>
