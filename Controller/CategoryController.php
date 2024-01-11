<?php

// include "Model\Category\categoryDAO.php";


Class CategoryController{
    private $categoryDAO;

    public function __construct() {
        $this->categoryDAO = new categoryDAO();
    }


    // public function Display(){

    //     $Category = $this->categoryDAO->getAllCategories();
    //     include_once "View\AdminDashboard.php";

    // }

    public function AddCategory(){
     

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_name = $_POST['categoryName'];
            $category = new ClassCategory(0,$category_name,0 );

          
            $this->categoryDAO->addCategory($category);
          
            header("Location: index.php?action=Admindashboardd");
            exit();
        }
    }
     public function ModifyCategory($cat_id){
        // getCategoryById($cat_id)

        // $Cat = $this->categoryDAO->getCategoryById($cat_id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Cat_name = $_POST['modifiedCategoryName'];
      
         $existingCategory = new ClassCategory( $cat_id,$Cat_name,0);
         
        $this->categoryDAO->updateCategory($existingCategory);
            // var_dump($existingCategory);
            header("Location: index.php?action=Admindashboardd");
           
        } else {
            echo 'error';
        }
    }
        public function DeleteCategory($cat_id){
            // $Cat = $this->categoryDAO->getCategoryById($cat_id);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
                $this->categoryDAO->deleteCategory($cat_id);
    
                header("Location: index.php?action=Admindashboardd");
      
            } else {
               
            }
        }

     }




