<?php
// include_once "Model\Wiki_Tags\WikiTagsDAO.php" ;
// include_once "Model\Wikis\WikisDAO.php" ;
// include_once "Model\Users\UsersDAO.php" ;
// include_once "Model\Tags\TagsDAO.php" ;
// include_once "Model\Category\CategoryDAO.php";



include_once "Controller\UsersController.php";





if (ISSET($_GET['action'])){
    $action = $_GET["action"];

    $Usercontroller = new UsersController();

 switch ($action){

    case 'Login':
        $Usercontroller->login();
        break;
    case 'Register':
       $Usercontroller->registerAutor();
        break;
    // case '':
      
    //     break;
    // case '':
       
    //     break;

    // default:
       
    //     break;
} 

} else{   
    // $HomeController = new  ControllerHome();
    //     $HomeController->index();
 }

























?>