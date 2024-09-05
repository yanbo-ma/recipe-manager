<?php
include 'header.php';
include './dao/RecipeManager.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$recipeManager = new RecipeManager();

// recipe details
$recipe = $recipeManager->getRecipeById($id);

if (!$recipe) {
    echo "Recipe not found.";
    exit;
}

// Handle recipe deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    if ($recipeManager->deleteRecipeById($id)) {
        echo "Recipe deleted successfully.";
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting recipe.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['title']); ?> - Recipe</title>
    <link rel="stylesheet" href="./css/recipe.css">
</head>
<body>
    <main class="content">
        <section class="recipe-header">   
            <img src="uploads/<?php echo htmlspecialchars($recipe['image']); ?>" alt="A picture of <?php echo htmlspecialchars($recipe['title']); ?>" id="recipe-image" name="recipe-image">
            <div class="recipe-title">
                <h2 id="new-title" name="new-title"><?php echo htmlspecialchars($recipe['title']); ?></h2>
                <p id="new-description" name="new-description"><i><?php echo htmlspecialchars($recipe['description']); ?></i></p>
                <span id="total-time" name="total-time"><b>Total time:</b> <?php echo htmlspecialchars($recipe['total_time']); ?> min</span><br>
                <span id="cuisine" name="cuisine"><b>Cuisine:</b> <?php echo htmlspecialchars($recipe['cuisine']); ?></span><br>
                <span id="dietary-preference" name="dietary-preference"><b>Dietary Preference:</b> <?php echo htmlspecialchars($recipe['dietary_preference']); ?></span><br>
                <span id="created-by" name="created-by"><b>Created by:</b> <?php echo htmlspecialchars($recipe['username']); ?></span>
            </div>
            <div class="recipe-button">
                <form method="post" action="">
                    <button name="share" id="share" type="button" onclick="shareRecipe()">Share</button>
                    <button name="remove" id="remove" type="submit">Remove</button>
                </form>
            </div>   
        </section>
        <div class="recipe-content-container">
            <section class="ingredient">
                <h3><b>INGREDIENTS</b></h3>
                <ul>
                    <?php
                    $ingredients = explode("\n", $recipe['ingredients']);
                    foreach ($ingredients as $ingredient) {
                        echo '<li>' . htmlspecialchars($ingredient) . '</li>';
                    }
                    ?>
                </ul>
            </section>
            <section class="instruction">
                <h3><b>PREPARATION</b></h3>
                <?php
                $steps = explode("\n", $recipe['steps']);
                foreach ($steps as $index => $step) {
                    echo '<h4><b>Step ' . ($index + 1) . '</b></h4>';
                    echo '<p>' . htmlspecialchars($step) . '</p>';
                }
                ?>
            </section>
        </div>
    </main>
    <footer class="footer"> 
        <div class="footer-content text-center"> 
            <h5> 
                Copyright © 2024 All rights reserved
            </h5> 
        </div> 
    </footer>

    <script src="./scripts/recipe.js"></script>

</body>
</html>
