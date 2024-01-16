<?php
// include 'Model\Wikis\WikisDAO.php';


class WikisController
{
    private $WikiDAO;
    private $TagsDAO;
    private $CategoryDAO;

    public function __construct()
    {
        $this->WikiDAO = new WikisDAO();
        $this->TagsDAO = new TagsDAO();
        $this->CategoryDAO = new CategoryDAO();
    }


    public function WikisAdd()
    {
        $Tags = $this->TagsDAO->getAllTags();
        $Category = $this->CategoryDAO->getAllCategories();
        include 'View\WikiAdd.php';
        // if (isset($_SESSION['auteur_role'])) {
        //     $user_id =  $_SESSION['user_id'];
        // } else {
        //     exit("User ID not found in the session.");
        // }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];
            $cat = $_POST['Category'];
            // $cat_id = $this->CategoryDAO->getCategoryIdByName($cat_name);
            $title = $_POST['Title'];
            $content = $_POST['content'];



            $imageFileName = '';
            if ($_FILES['Image']['error'] == UPLOAD_ERR_OK) {
                $targetDirectory = 'View/Assets/Imgs/';
                $imageFileName = $targetDirectory . basename($_FILES['Image']['name']);
                move_uploaded_file($_FILES['Image']['tmp_name'], $imageFileName);
            }
            $tag = isset($_POST['Tags']) ? $_POST['Tags'] : [];
            // $tag = $_POST['Tags[]'];
            // $title_err ='';
            // $content_err ='';
            // $cat_err ='';
            // $tag_err ='';
            // if(empty($title))
            // {
            //     $title_err = "Enter Title ";
            // }
            // if(empty($content))
            // {
            //     $content_err = "Enter Content";
            // }
            // if(empty($cat))
            // {
            //     $cat_err = "Veuillez entrez la category du wiki";
            // }
            // if(empty($tag))
            // {
            //     $tag_err = "Veuillez entrez des tags pour le wiki";
            // }
            $wiki = new ClassWiki(0, $user_id, $cat, $title, $content, 0, 0, $tag, $imageFileName);
            $this->WikiDAO->addWiki($wiki, $imageFileName);
        }
        // header("Location: index.php?action=Autorprofile");
    }

    public function DisplayWiki()
    {


        $wiki = $this->WikiDAO->displayAllWikis();
        $cats = $this->CategoryDAO->getAllCategories();
        $tgs = $this->TagsDAO->getAllTags();
        include_once "View\home.php";



    }
    public function DisplayDetailsWiki($Wiki_id)
    {
        $wikid = $this->WikiDAO->displayWikiById($Wiki_id);
        // $cats=$this->CategoryDAO->getAllCategories();
        // $tags=$this->TagsDAO->getAllTags();
        include_once "View\DetailsWiki.php";



    }


    public function searchAction()
    {
        $query = $_GET['query'];


        // $results = $this->WikiDAO->liveSearchWiki($query);
        $results = $this->WikiDAO->searchWikisByQuery($query);

        $result_id = [];

        foreach($results as $r) {
            $result_id[] = $r->getWiki_id();
        }

        // Output the search results
        // header('Content-Type: application/json');
        echo json_encode($result_id);
        // echo $query;
        // print_r($_GET);
    }

    public function ModifyWiki($wiki_id)
    {
        $Tags = $this->TagsDAO->getAllTags();
        $taginwiki = $this->WikiDAO->getTagsForWiki($wiki_id);
        $Category = $this->CategoryDAO->getAllCategories();
    $wikis = $this->WikiDAO->displayWikiById($wiki_id);
    // var_dump($taginwiki);
    include_once "View\EditWiki.php";
    }
    public function handleModifyWiki($wiki_id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wikis = $this->WikiDAO->displayWikiById($wiki_id);
            $user_id = $_POST['user_id'];
            $new_Title = $_POST['new_Title'];
            $new_content = $_POST['new_content'];
            $new_Category = $_POST['new_Category'];
            $new_Tags = isset($_POST['new_Tags']) ? $_POST['new_Tags'] : [];
            $imageFileName = '';
    
        
            if ($_FILES['new_Image']['error'] == UPLOAD_ERR_OK) {
                $targetDirectory = 'View/Assets/Imgs/';
                $imageFileName = $targetDirectory . basename($_FILES['new_Image']['name']);
                move_uploaded_file($_FILES['new_Image']['tmp_name'], $imageFileName);
            } else {
                $imageFileName = $wikis->getImage();
            }
    
            $wiki = new ClassWiki($wiki_id, $user_id, $new_Category, $new_Title, $new_content, 0, 0, $new_Tags, $imageFileName);
            $this->WikiDAO->modifyWiki($wiki, $imageFileName);
        }
  
    header("Location: index.php?action=Autorprofile");
    }

    public function ProfileAutor(){
        session_start(); 
        if (isset($_SESSION['auteur_role']) && $_SESSION['auteur_role'] === true) {
            $User_id = $_SESSION['user_id'];
//  var_dump($User_id);
        $wikibyid = $this->WikiDAO->displayWiki($User_id);
            // var_dump ($wikibyid);
        include_once "View\Autorprofile.php";
    }

}

    public function DeleteWiki($wiki_id){
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->WikiDAO->deleteWiki($wiki_id) ;
       header("Location: index.php?action=Autorprofile");
        }
    
}
public function ArchieveWiki($wiki_id){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->WikiDAO->archiveWiki($wiki_id) ;
         header("Location: index.php");
          }
}

public function showStatistics() {
    $userData = $this->WikiDAO->getWikisPerUser();
    $categoryData = $this->WikiDAO->getWikisPerCategory();


    include 'View\Statistics.php';
}
  
}

