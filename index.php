<?php

include_once "Model\Wikis\WikisDAO.php" ;
include_once "Model\Users\UsersDAO.php" ;
include_once "Model\Tags\TagsDAO.php" ;
include_once "Model\Category\CategoryDAO.php";



include_once "Controller\UsersController.php";
include_once "Controller\WikiController.php";
include_once "Controller\CategoryController.php";
include_once "Controller\TagsController.php";
include_once "Controller\AdminController.php";





if (ISSET($_GET['action'])){
    $action = $_GET["action"];
    $CategoryController = new CategoryController();
    $Usercontroller = new UsersController();
    $Wikiscontroller = new WikisController();
    $TagsController = new TagsController();
    $AdminController = new AdminController();

 switch ($action){

    case 'Authentification':
        $Usercontroller->login();
        break;
    case'Register':
        $Usercontroller->registerAutor();
        break;
    case 'WikisAdd':
      $Wikiscontroller->WikisAdd();
        break;
    case 'Admindashboardd':
        $AdminController->Display();
      
        break;
    case 'AddCategory':
        $CategoryController->AddCategory();
        break;
        case 'AddTag':
            $TagsController->AddTags();
            break;
    case 'ModifyCategory':
        $CategoryController->ModifyCategory($_GET['cat_id']);
        break;
    case 'ModifyTag':
        $TagsController->ModifyTag($_GET['tag_id']);
        break;
    case'DeleteCategory':
        $CategoryController->DeleteCategory($_GET['cat_id']);
        break;
    case 'DeleteTag':
        $TagsController->DeleteTag($_GET['tag_id']);
        break;
    case 'Logout':
        $Usercontroller->logout();
        break;
    
        

    // default:
       
    //     break;
} 

} else{   
    // $HomeController = new  ControllerHome();
    //     $HomeController->index();
 }

























?>