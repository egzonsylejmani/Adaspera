<?php  

include '../components/header.php';
include_once '../businessLogic/UserMapper.php';
if(!isset($_SESSION['is_logged_in']) || $_SESSION['role'] >= 0){
    $mapper =  new UserMapper();
    $userList = $mapper->getAllUsers();
    $user = $mapper->getUserByEmail($_SESSION['email']);
    if($user['sex'] =='M'){
      $user['sex'] = 'Male';
    }else{
      $user['sex']='Female';
    }
}

?>


  <div class="logout-form">
      <div class="edit-user-card">

            <a class ="edit-label" style="margin:5px 0 5px 0;"><b>First Name</b></a>
            <p class ="edit-label" style="margin:5px 0 5px 0; font-size:10pt;"><?= $user['first_name'] ?></p>
            <a class ="edit-label" style="margin:5px 0 5px 0; "><b>Last Name</b></a>
            <p class ="edit-label" style="margin:5px 0 5px 0; font-size:10pt;"><?= $user['last_name'] ?></p>
            <a class ="edit-label" style="margin:5px 0 5px 0; "><b>Mobile</b></a>
            <p class ="edit-label" style="margin:5px 0 5px 0; font-size:10pt;"><?= $user['mobile'] ?></p>
            <a class ="edit-label" style="margin:5px 0 5px 0; "><b>Gender</b></a>
            <p class ="edit-label" style="margin:5px 0 5px 0; font-size:10pt;"><?= $user['sex'] ?></p>
            <a class ="edit-label" style="margin:5px 0 5px 0; "><b>Birthday</b></a>
            <p class ="edit-label" style="margin:5px 0 5px 0; font-size:10pt;"><?= $user['birthday'] ?></p>

            <a class ="edit-label" style="margin:5px 0 5px 0;"><b>Email</b></a>

            <p class ="edit-label" style="margin:5px 0 15px 0; font-size:10pt;"><?= $user['email'] ?></p>
          
            <a href="logout.php" class="btn">Logout</a>
        </div>
  </div>
   




