<?php
include_once "Model\Tags\TagsDAO.php";

Class TagsController{
        private $TagsDAO;
    
        public function __construct() {
            $this->TagsDAO = new TagsDAO();
        }

        // public function Display(){
        //     $Tags = $this->TagsDAO->getAllTags();

        //     include_once "View\AdminDashboard.php";
        // }
        public function AddTags(){
            try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               
                $Tag = $_POST['Tag'];
                $Tags = new ClassTag(0,$Tag );
                $this->TagsDAO->addTag($Tags);
              }
                header("Location: index.php?action=Admindashboardd");
                
            }
            catch (PDOException $e){
                $errorMessage= "message" . $e->getMessage();

            }
            $redirectURL = "index.php?action=Admindashboardd";
            if ($errorMessage !== "") {
                $redirectURL .= "&error=" . urlencode($errorMessage);
            }
        
            // Redirect to the admin dashboard with or without the error message
            header("Location: " . $redirectURL);
        }
         public function ModifyTag($tag_id){
            // $Tag = $this->TagsDAO->getTagById($tag_id);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $Tag = $_POST['modifiedTagName'];
            // $existingTag = $this->TagsDAO->getTagById($tag_id);
             $existingTag = new ClassTag( $tag_id,$Tag);
          
            //  var_dump($existingTag);
            $this->TagsDAO->updateTag($existingTag);
            
                header("Location: index.php?action=Admindashboardd");

            
               
               
            } 
        }
            public function DeleteTag(){
                // $Tag = $this->TagsDAO->getTagById($tag_id);

                $id = $_GET['tag_id'];
               var_dump($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                    $this->TagsDAO->deleteTag($id);
        
                    header("Location: index.php?action=Admindashboardd");

                    
                } 
            }
    
    }