<?php
// include 'Model\Wikis\WikisDAO.php';


Class WikisController{
    private $WikiDAO;
    private $TagsDAO;
    private $CategoryDAO;

    public function __construct() {
        $this->WikiDAO = new WikisDAO();
        $this->TagsDAO = new TagsDAO();
        $this->CategoryDAO = new CategoryDAO();
    }


    public function WikisAdd(){
        $Tags = $this->TagsDAO->getAllTags();
        $Category = $this->CategoryDAO->getAllCategories();
        include 'View\WikiAdd.php';

    }



}