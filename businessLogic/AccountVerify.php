<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'Admin.php';
include_once 'User.php';
require_once 'UserMapper.php';
require_once 'Authenticate.php';
session_start();
  if(isset($_SESSION['is_logged_in'])) {

}
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = new LoginVerify($email, $password);
    $login->verifyData();
} else if (isset($_POST['register'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mobile = $_POST['mobile'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $register = new RegisterVerify($firstname, $lastname,$birthday,$mobile,$sex, $email, $password);
    $register->insertData();
}else {
    header("Location: ../views/index.php");
}