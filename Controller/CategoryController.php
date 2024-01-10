<?php

include "Model\Category\CategoryDAO.php";


Class CategoryController{
    private $CategoryDAO;

    public function __construct() {
        $this->CategoryDAO = new CategoryDAO();
    }


    public function DisplayCategories(){

        $Category = $this->CategoryDAO->getAllCategories();
        // include_once "View\WikiAdd.php";

    }





}