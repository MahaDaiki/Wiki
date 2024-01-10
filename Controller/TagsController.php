<?php
include_once "Model\Tags\TagsDAO.php";

Class TagsController{
        private $TagsDAO;
    
        public function __construct() {
            $this->TagsDAO = new TagsDAO();
        }

        public function DisplayTags(){
            $Tags = $this->TagsDAO->getAllTags();

            include_once "";
        }

    }