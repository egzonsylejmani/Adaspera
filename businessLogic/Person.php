<?php

abstract class Person {
    protected $name;
    protected $lastname;
    protected $email;
    protected $password;
    protected $sex;
    protected $mobile;
    protected $birthday;
    protected $role;

    function __construct($name, $lastname, $email, $password,$birthday,$sex,$mobile, $role){
        $this->name=$name;
        $this->lastname=$lastname;
        $this->email=$email;
        $this->password=$password;
        $this->role=$role;
        $this->mobile=$mobile;
        $this->sex=$sex;
        $this->birthday=$birthday;
    }

    abstract protected function setSession();
    abstract protected function setCookie();
}