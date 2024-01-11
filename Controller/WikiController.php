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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            exit("User ID not found in the session.");
        }
    
        $cat_name = $_POST['Category'];
        $cat_id = $this->CategoryDAO->getCategoryIdByName($cat_name);
        $title = $_POST['Title'];
        $content = $_POST['content'];
        $imageFileName = '';
    
        if ($_FILES['Image']['error'] == UPLOAD_ERR_OK) {
            $targetDirectory = 'View/Assets/Imgs/';
            $imageFileName = $targetDirectory . basename($_FILES['Image']['name']);
            move_uploaded_file($_FILES['Image']['tmp_name'], $imageFileName);
        }
    
        $tagNames = $_POST['Tags'];
        $tagIds = $this->TagsDAO->getTagIdsByNames($tagNames);
    
        $wiki = new ClassWiki(0, $user_id, $cat_id, $title, $content, 0, 0, $tagIds, $imageFileName);
        var_dump($wiki);
        $this->WikiDAO->addWiki($wiki, $imageFileName);
    }
}
    
   
    
    




}