<?php

include_once 'Model\Connection\Connection.php';
include_once 'Model\Category\ClassCategory.php';

class CategoryDAO {
    private $pdo;

    public function __construct(){
        $this->pdo = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function addCategory($category) {
        $query = "INSERT INTO categories (category_name) VALUES ('".$category->getCategory_name()."')";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories ORDER BY Cat_date_created DESC ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $categoriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = array();
        foreach ($categoriesData as $categoryData) {
            $categories[] = new ClassCategory($categoryData['cat_id'], $categoryData['category_name'], $categoryData['cat_date_created']);
        }

        return $categories;
    }

    public function getCategoryById($cat_id) {
        $query = "SELECT * FROM categories WHERE cat_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$cat_id]);
        $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($categoryData) {
            return new ClassCategory($categoryData['cat_id'], $categoryData['category_name'], $categoryData['cat_date_created']);
        }

        return null;
    }

    public function updateCategory($category) {
        $query = "UPDATE categories SET category_name = ? WHERE cat_id = ?";
        $stmt = $this->pdo->prepare($query);
      
        $stmt->execute([$category->getCategory_name(), $category->getCat_id()]);
    }

    public function deleteCategory($cat_id) {
        $query = "DELETE FROM categories WHERE cat_id = ?";
        $stmt = $this->pdo->prepare($query);
        var_dump($stmt);
        $stmt->execute([$cat_id]);
    }

    public function getCategoryIdByName($categoryName) {
        $query = "SELECT cat_id FROM categories WHERE category_name = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$categoryName]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['cat_id'];
        }
        return null;
    }
}

?>
