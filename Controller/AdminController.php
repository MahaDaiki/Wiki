<?php
Class AdminController{
    private $TagsDAO;
    private $categoryDAO;
    public function __construct() {
        $this->TagsDAO = new TagsDAO();
        $this->categoryDAO = new categoryDAO();
    }

    public function Display(){
        $Category = $this->categoryDAO->getAllCategories();
        $Tags = $this->TagsDAO->getAllTags();
        include_once "View\AdminDashboard.php";
    }





}



?>