<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$page = basename($_SERVER['PHP_SELF']);
session_start();
if($page=="product-list.php"){  
    if(isset($_GET["page"])){
    $page_query = $_GET["page"];
}else{
       header("Location: product-list.php?page=New");

}   
}

if($page=="product-page.php"){  
    if(isset($_GET["pid"])){
    $page_query = $_GET["pid"];
}   else{
       header("Location: product-list.php?page=New");

} 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaspera</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>



<body>


    <header style="background:#ffffff; border-bottom: 1px solid ;padding-bottom: 15px;">
        <nav>
            <div class="nav-header">
                <div></div>
                <div class="nav-logo">
                    <a href="index.php">
                        <img src="../assets/logo-colored.svg" alt="Adaspera" class="logo-img">
                        </img>
                    </a>

                </div>
                <div class="navbar-icons">
                    <ul>
                        <?php 
                        if(isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 1 ){

                            echo '<a href="dashboard.php" class="rectangle-dashboard">Dashboard</a>';
                        }
                        ?>
                        <a href="account.php">
                            <img src="../assets/images/user.png">
                        </a>
                        <a href="cart.php">
                            <img src="../assets/images/online-shopping.png">
                        </a>
                    </ul>
                </div>

            </div>


            </div>


            <div class="menu-nav">
                <nav>
                    <ul>
                        <li class="<?php if($page == 'product-list.php' && $page_query == "New"){ echo ' active';}?>"><a
                                href="product-list.php?page=New" class="<?php if($page == 'product-list.php' && $page_query == "New"){ echo ' activeBorder';}?>">New</a></li>



                        <li class="<?php if($page == 'product-list.php' && $page_query == "Women"){ echo ' active';}?>">
                            <a href="product-list.php?page=Women" class="<?php if($page == 'product-list.php' && $page_query == "Women"){ echo ' activeBorder';}?>">
                                Women
                            </a>
                        </li>
                        <li class="<?php if($page == 'product-list.php' && $page_query == "Men"){ echo ' active';}?>"><a
                                href="product-list.php?page=Men" class="<?php if($page == 'product-list.php' && $page_query == "Men"){ echo ' activeBorder';}?>">
                                Men
                            </a></li>

                        <li class="<?php if($page == 'product-list.php' && $page_query == "Kids"){ echo ' active';}?>">
                            <a href="product-list.php?page=Kids" class="<?php if($page == 'product-list.php' && $page_query == "Kids"){ echo ' activeBorder';}?>">Kids</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </nav>
    </header>
    <script>
    if (document.querySelector(".rectangle-dashboard")) {
        window.addEventListener("resize", reportWindowSize);

        function reportWindowSize() {
            if (window.innerWidth > 991) {
                document.querySelector(".logo-img").style.left = "92px";
            }

            if (window.innerWidth > 767 && window.innerWidth < 992) {
                document.querySelector(".logo-img").style.left = "75px";
            }
            if (window.innerWidth > 450 && window.innerWidth < 768) {
                document.querySelector(".logo-img").style.left = "52px";
            }
            if (window.innerWidth > 300 && window.innerWidth < 450) {
                document.querySelector(".logo-img").style.left = "38px";
            }
        }
        if (window.innerWidth > 991) {
            document.querySelector(".logo-img").style.left = "92px";
        }

        if (window.innerWidth > 767 && window.innerWidth < 992) {
            document.querySelector(".logo-img").style.left = "75px";
        }
        if (window.innerWidth > 450 && window.innerWidth < 768) {
            document.querySelector(".logo-img").style.left = "52px";
        }
        if (window.innerWidth > 300 && window.innerWidth < 450) {
            document.querySelector(".logo-img").style.left = "38px";
        }
    }
    </script>