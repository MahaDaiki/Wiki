<?php 
include_once "Model/Users/UsersDAO.php";



Class UsersController{
        private $userDAO;
    
        public function __construct() {
            $this->userDAO = new UserDAO();
        }
           //filter_var($email, FILTER_SANITIZE_EMAIL) for sanitazing email
        //filter_var($email, FILTER_VALIDATE_EMAIL) For checking the email if its a valid email 
        public function registerAutor() {
            $result = true;
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get user input
                $username = $_POST['signup-user'];
                $email = $_POST['signup-email'];
                $password = $_POST['signup-pass'];
                $confirm_password = $_POST['signup-pass-repeat'];
        
                // Regular expression for username
                $usernamePattern = '/^[a-zA-Z0-9_]{3,20}$/';
                
                // Regular expression for password
                $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/';
        
                if (!preg_match($usernamePattern, $username)) {
                    $result = false;
                    echo '<span  style=" background:red ; color: white;  display: block; text-align: center; padding: 5px;">Invalid username format</span>';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $result = false;
                    echo '<span  style=" background:red ; color: white;  display: block; text-align: center; padding: 5px;">Invalid email format</span>';
                } elseif (strlen($password) < 6 || !preg_match($passwordPattern, $password)) {
                    $result = false;
                    echo '<span  style=" background:red ; color: white;  display: block; text-align: center; padding: 5px;">Invalid password format</span>';
                } elseif ($password !== $confirm_password) {
                    $result = false;
                    echo '<span   style=" background:red ; color: white; display: block; text-align: center; padding: 5px;">Passwords do not match</span>';
                }
        
                if ($result) {
                    $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
                    echo '<span  style="background:green; color: White;display: block; text-align: center; padding: 5px;">Registration successful!</span>';
                    $user = new ClassUsers(0, $username, $email, $hashedpassword, 0);
                    $result = $this->userDAO->registerUser($user);
                    header("Location: /index.php?action=Authentification");
                } else {
                    echo '<span   style=" background:red ; color: white;display: block; text-align: center; padding: 5px;">Registration failed. Please try again.</span>';
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
                            $_SESSION['auteur_role'] = true;
                            header("Location: /index.php");
                            exit();
                        } elseif ($user['role'] == 'admin') {
                            $_SESSION['admin_role'] = true;
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





    