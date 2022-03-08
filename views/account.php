 <?php 
include_once '../components/header.php';

    if(isset($_SESSION['is_logged_in'])) {
        header("Location: logout-form.php")
        
        ?>
    
<?php 

} else { 

    ?>
    <div class="account_page_form">
       

        <form class="login-form" method="POST" action="../businessLogic/AccountVerify.php" >

            <ul>
                <li class="nav-item login active">
                    <a href="">
                        Login with account?
                    </a>
                </li>
                <li class="nav-item register">
                    <a href="">
                        No account?
                    </a>
                </li>
            </ul>
             <div class ="error-msg">
            <span id="error-message"><?php 
            if(isset($_GET["login"])){
                if($_GET["login"] == "error"){
                echo "* Login Failed!";
                }
            }
            
            ?></span>
        </div>  
            <div class="form-margins">
            <input type="text" class="form-control"  name="email" id ="login-email" placeholder="* Email address" required>
                    <span  id="emailrequired"></span>
    
            </div>
            <div class="form-margins">
            <input type="password" class="form-control" name = "password" id ="login-password" placeholder="* Password" required>
                        <span  id="passwordrequired"></span>
    
        </div>
            <div style="text-align: right; font-size: 15px;">
                <a style="text-decoration: none;" href="">Forgot Password?</a>
            </div>
            <div class="form-buttons">
                <button type = "submit" name = "login" value = "Login" class="btn-primary">
                    Login
                </button>
                <button class="btn-secondary">
                    Register
                </button>
            </div>
        </form>

        <form class="register-form" style="display:none" action="../businessLogic/AccountVerify.php" method="POST">

            <ul>
                <li class="nav-item login ">
                    <a href="">
                        Login with account?

                    </a>
                </li>
                <li class="nav-item register active">
                    <a href="">
                        No account?
                    </a>
                </li>
            </ul>

            <span id="error-message"><?php 
            if(isset($_GET["register"])){
                if($_GET["register"] == "error"){
                echo "* Register Failed!";
                }
            }
            
            ?></span>
            <h3 style="margin: 0 0 20px 0;">Personal Details </h3>
            <div class="form-margins">
            <input type="text" class="form-control" name="firstname" placeholder="* First name" required>
            <span  id="firstName"></span>
            </div>
            <div class="form-margins">
            <input type="text" class="form-control" name="lastname" placeholder="* Last name" required>
            <span id="lastName"></span>
            </div>
            <div class="form-margins">
            <div style="display:flex">
                <input type="radio" class="gender-select" data-label="Female" name="sex" value ="F" required>
                <a style="margin: 14px 23px 0px -11px;">Female</a>
                <input type="radio" class="gender-select" data-label="Male" name="sex" value ="M" required>
                <a style="margin: 14px 23px 0px -11px;">Male</a>
                <span id="gender"></span>
            </div>
            </div>
            <div class="form-margins">
            <input type="date" class="form-control" name="birthday"placeholder="* Date of birth" required>
            <span  id="dateBirthday"></span>
            </div>
            <div class="form-margins">
            <input type="text" class="form-control" name="mobile"placeholder="* Phone number" required>
            <span  id="mobile-phone"></span>
            </div>
            <div class="form-margins">
            <input type="text" class="form-control"name="register-email" placeholder="* Email address" required>
            <span  id="email-address"></span>
            </div>
            <div class="form-margins">
            <input type="password" class="form-control"name="register-password" placeholder="* Password" required>
            <span  id="password"></span>
            </div>
            <div class="form-margins">
            <input class="btn-primary" type="submit" name ="register" value="Register" style="margin-top: 22px;">
            
            </input >
            </div>
        </form>

    </div>
    
<?php } 
?>
    <script src="../assets/script.js"></script>

<?php
include_once '../components/footer.php'; ?>