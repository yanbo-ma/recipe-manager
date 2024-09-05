<?php
include 'header.php';
include('./dao/database.php');

// search parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchType = isset($_GET['search-type']) ? $_GET['search-type'] : '';

// SQL query
$sql = "SELECT * FROM recipes";
if ($search != '' && $searchType != '') {
    $sql .= " WHERE $searchType LIKE '%$search%'";
}

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
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
<body>
    <main class="content">
        <div class="result-header">
            <h2>Saved recipes:</h2>
            <form class="search-form" id="search-form" method="get">
                <div class="search-bar">
                    <input type="text" placeholder="Search..." class="search-input" id="search-input" name="search">
                    <button type="submit" class="search-button" id="search-button">Search</button>
                </div>
                <div class="search-option">
                    <label for="s0">Recipe Name</label>
                    <input type="radio" name="search-type" id="s0" value="title">
                    <label for="s1">Ingredients</label>
                    <input type="radio" name="search-type" id="s1" value="ingredients">
                    <label for="s2">Cuisine</label>
                    <input type="radio" name="search-type" id="s2" value="cuisine">
                    <label for="s3">Dietary Preference</label>
                    <input type="radio" name="search-type" id="s3" value="dietary_preference">
                </div>
                <div class="feedback-message" id="feedback-message"></div>
            </form>
        </div>
        <div class="result">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="recipe" onclick="location.href=\'recipe.php?id=' . $row['id'] . '\'">';
                    echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '" class="recipe-image">';
                    echo '<h2 class="recipe-title">' . htmlspecialchars($row['title']) . '</h2>';
                    echo '</div>';
                }
            } else {
                echo '<p>No recipes found.</p>';
            }
            ?>
            <div id="new-recipe" onclick="location.href='new_recipe.php'">
                <img src="images/plus-circle.svg" alt="Create new recipe">
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-content text-center">
            <h5>
                Copyright © 2024 All rights reserved
            </h5>
        </div>
    </footer>

    <script src="./scripts/index.js"></script>

</body>
</html>
