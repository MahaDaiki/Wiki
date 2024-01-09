<?php
include_once 'Model\Connection\Connection.php';
include_once  'Model\Users\ClassUsers.php';
class UserDAO {
    private $pdo;

    public function __construct(){
        $this->pdo = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function registerUser($user) {
       
        $role = $user->getRole() ? $user->getRole() : 'auteur';
    
        $stmt = $this->pdo->prepare("INSERT INTO Users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getPassword(), $role]);
        return $result;
    }

    // public function loginUser($email, $password) {
    //     $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE email = ? AND password = ?");
    //     $stmt->execute([$email, $password]);
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // if ($user && password_verify($password, $user['password'])) {
        //     session_start();
        //     $_SESSION['user_id'] = $user['user_id'];
        //     $_SESSION['username'] = $user['username'];

        //     if ($user['role'] == 'auteur') {
        //         $_SESSION['role'] = 'auteur';
        //         header("Location: home.php");
        //     } elseif ($user['role'] == 'admin') {
        //         $_SESSION['role'] = 'admin';
        //         header("Location: admin_dashboard.php");
        //     }
        // } else {
            
        //     echo "Invalid email or password";
        // }
    // }

    // public function getHashedPassword($email) {
    //     $stmt = $this->pdo->prepare("SELECT password FROM Users WHERE email = ?");
    //     $stmt->execute([$email]);
    //     $hashedPassword = $stmt->fetchColumn();

    //     return $hashedPassword;
    // }
    public function getUserByEmailAndPassword($email, $password) {
        $query=("SELECT * FROM Users WHERE email = ?");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }
}