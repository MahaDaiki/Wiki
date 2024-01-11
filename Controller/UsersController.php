<?php 
include_once "Model/Users/UsersDAO.php";



Class UsersController{
        private $userDAO;
    
        public function __construct() {
            $this->userDAO = new UserDAO();
        }
        
            public function registerAutor() {
                $result = true;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Get user input
                 
                    $username = $_POST['signup-user'];
                    $email = $_POST['signup-email'];
                    $password = $_POST['signup-pass'];
                    $confirm_password = $_POST['signup-pass-repeat'];
                    //  $role = ['role'] ?: 'auteur'; 
        
     
                // if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
                //     echo "Invalid username format";
                //     return;
                // }
        //filter_var($email, FILTER_SANITIZE_EMAIL) for sanitazing email
        //filter_var($email, FILTER_VALIDATE_EMAIL) For checking the email if its a valid email 
        $usernamePattern = '/^[a-zA-Z0-9_]{2,20}$/';
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/';

        if (preg_match($usernamePattern, $username)) {
            // Valid username, continue processing
        } 
                elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                   $result = false ;
                   
                }

        //strlen for password length
        
        elseif (strlen($password) >= 6 && preg_match($passwordPattern, $password)){
                $result= false ;
             
                }

                elseif ($password !== $confirm_password) {
                  $result= false ;

             
                }
                
        
              if ($result) {
                $hashedpassword = password_hash($password, PASSWORD_BCRYPT); 
                    echo "Registration successful!"; 
                    $user = new ClassUsers(0,$username, $email, $hashedpassword, 0);

        
                $result = $this->userDAO->registerUser($user);
                header("Location: /index.php?action=Authentification");
                } else {
                
                    echo "Registration failed. Please try again.";
                }
            }
            
            include_once "View\Login.php";
            }


            public function login() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $email = $_POST['login-user'];
                    $password = $_POST['login-pass'];
        
                    $user = $this->userDAO->getUserByEmailAndPassword($email, $password);
        
                    if ($user) {
                        session_start();
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
        
                        if ($user['role'] == 'auteur') {
                            $_SESSION['role'] = 'auteur';
                            header("Location: home.php");
                            exit();
                        } elseif ($user['role'] == 'admin') {
                            $_SESSION['role'] = 'admin';
                            header("Location: /index.php?action=Admindashboardd");
                            exit();
                        }
                    } else {
                        echo "Invalid email or password";
                    }
                }
                 include_once "View\Login.php";
            }

            public function logout()
            {
               session_start();
                $_SESSION = array();
                session_destroy();
                header("Location: index.php?action=Authentification");
                exit();
            }
       
        }


// $authController = new AuthController();
// $authController->login();



    