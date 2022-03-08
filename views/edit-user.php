<?php 
include_once '../businessLogic/UserMapper.php';
include_once '../businessLogic/User.php';
require '../businessLogic/Authenticate.php';
include '../components/header.php';


if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) 
    && $_SESSION['is_logged_in'] == 1 && $_SESSION['role'] == 1){
        
    $errors = [];
    $mapper = new UserMapper();
    if(isset($_GET['action']) && $_GET['action'] == 'edit-user'){
        $user = $mapper->getUserByID($_GET['user-id']);
    }

    if(isset($_POST['update-user-btn'])){
     $mapper = new UserMapper();
        $user = $mapper->getUserById($_POST['id']);

        $id = $_POST['id'];
        $first_name = $_POST['name'];
        $last_name = $_POST['lastname'];
        $sex =$user["sex"];

        $mobile = $user["mobile"];
        $birthday = $user["birthday"];
        $email = $_POST['email'];
        $password = $_POST['pw'];

        $auth = new RegisterVerify($first_name, $last_name,$birthday,$mobile,$sex, $email, $password);

        if($auth->emptyInputs($first_name, $last_name, $email, $password,$mobile)){
            $errors[] = "Të gjitha të dhënat duhet të plotësohen";
            $user = $mapper->getUserById($id);
        }else if($auth->validEmailModification($id) == false){
            $errors[] = "Email-i që keni dhënë ekziston";
            $user = $mapper->getUserById($id);
        }else if($auth->validPassword() == false){
            $errors[] = "Fjalëkalimi duhet të ketë min. 8 karaktere, min. 1 shkronjë të madhe dhe min. 1 numër";
            $user = $mapper->getUserById($id);
        } else {
            $updateuser = new User($first_name, $last_name, $email,$password,$birthday,$sex,$mobile, 0);
            $mapper->edit($updateuser, $id);
            header("Location: dashboard.php?action=view-users");
        }
    }
?>  
    <div class="edit-user-main">
        <?php if(count($errors)) {?>
            <div class="llogaria-error" style="width: 430px;">
                <?php foreach($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php }?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="edit-user-card">
            <img src="../images/icons/user-circle-black.svg" alt="">
            <a class ="edit-label">User ID</a>

            <input readonly type="text" name="id" value="<?= $user['id'] ?>">
            <a class ="edit-label">First Name</a>
            <input type="text" name="name" value="<?= $user['first_name'] ?>">

            <a class ="edit-label">Last Name</a>
            <input type="text" name="lastname" value="<?= $user['last_name'] ?>">

            <a class ="edit-label">Email</a>
            <input type="email" name="email" value="<?= $user['email'] ?>">

            <a class ="edit-label">Password</a>
            <input type="password" name="pw" value="<?= $user['password'] ?>">

            <input class="button" type="submit" name="update-user-btn" style="background: black;color: #ffff;" value="Save Changes">
            <a href="dashboard.php?action=view-users">Cancel</a>
        </form>
    </div>

<?php } else {
    header("Location: index.php");
}
?>

<?php include '../components/footer.php'?>