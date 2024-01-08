<?php
Class ClassUsers{
    private $user_id;
    private $username;
    private $email;
    private $password;
    private $role;


public function __construct($user_id,$username,$email,$password,$role){
    $this->user_id = $user_id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->role = $role;
}


    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }
}


?>