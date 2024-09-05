<?php
class RecipeManager {
    private $conn;

    public function __construct() {
        include './dao/database.php';
        $this->conn = $conn;
    }

    public function getRecipeById($id) {
        $sql = "SELECT recipes.*, users.username FROM recipes 
                LEFT JOIN users ON recipes.created_by = users.id 
                WHERE recipes.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function deleteRecipeById($id) {
        $delete_sql = "DELETE FROM recipes WHERE id = ?";
        $stmt = $this->conn->prepare($delete_sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>
