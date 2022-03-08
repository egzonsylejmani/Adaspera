<?php
require_once 'ProductMapper.php';
require_once 'Product.php';
require_once 'addSlider.php';
require_once 'UserMapper.php';
require_once 'CartMapper.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();




if(isset($_POST['add-product-btn'])){

    $mapper = new UserMapper();

    // get from database the actual admin who is logged in
    $currentAdmin = $mapper->getUserByEmail($_SESSION['email']);

    $name = $_POST['name'];
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    $sizes_available = $_POST["sizes_available"];
    $admin_id = $currentAdmin['id'];


    $mapper = new ProductMapper();
    $product = new Product($product_id, $name, $price,$category,$image, $color, $admin_id, $sizes_available);


    if($mapper->insertProduct($product)){
        header("Location: ../views/dashboard.php?action=add-product&upload=success");
    }
    else{
        header("Location: ../views/dashboard.php?action=add-product&upload=error");
    }
} 
else if(isset($_GET['action']) && $_GET['action'] == 'add-to-cart'){
    if(isset($_GET['product_id'])){
        $usermapper = new UserMapper();
        $cartmapper = new CartMapper();
        $user = $usermapper->getUserByEmail($_SESSION['email']);

        $cartmapper->insertToCart($user['id'], $_GET['product_id'], $_GET['size']);
        header("Location: ../views/cart.php");
    }
}else if (isset($_POST['add-slider-img'])){
    $usermapper = new UserMapper();

    // get from database the actual admin who is logged in
    $currentAdmin = $usermapper->getUserByEmail($_SESSION['email']);

    $image_id = $_POST['image_id'];
    $image = $_POST['image'];
     $mapper = new ProductMapper();
    $image = new addSlider($image_id, $image);
    
    if($mapper->insertIntoSlider($image)){
        header("Location: ../views/dashboard.php?action=add-slider-images&upload=success");
    }
    else{
        header("Location: ../views/dashboard.php?action=add-slider-images&upload=error");
    }
}
//else send to index
else {
    header("Location: ../views/index.php");
}