<?php
require_once 'Person.php';

class User extends Person {

    public function __construct($name, $lastname, $email, $password,$birthday,$sex,$mobile, $role){
        parent::__construct($name, $lastname, $email, $password,$birthday,$sex,$mobile, $role);
    }

    public function setSession(){
        $_SESSION['role'] = 0;
        $_SESSION['rolename'] = "SimpleUser";
        $_SESSION['is_logged_in'] = true;
        $_SESSION['email'] = $this->email;
    }

    public function setCookie(){
        setcookie("email", $this->getEmail(), time() + 3600); //modify later
    }

    public function getFirstName(){
        return $this->name;
    }
    public function getSex(){
        return $this->sex;
    }
    public function getBirthday(){
        return $this->birthday;
    }
    public function getMobile(){
        return $this->mobile;
    }

    public function getLastName(){
        return $this->lastname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getRole(){
        return $this->role;
    }
}