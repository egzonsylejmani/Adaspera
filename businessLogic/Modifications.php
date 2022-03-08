<?php
include_once 'ProductMapper.php';
include_once 'UserMapper.php';
include_once 'CartMapper.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

//  If the user is logged in and admin continue;
if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1 && $_SESSION['role'] == 1){

    //create an instance of ProductMapper
    $pmapper = new ProductMapper();
    $mapper = new UserMapper();
    $user = $mapper ->getUserByEmail($_SESSION['email']);

    if(isset($_GET['action']) && ($_GET['action'] == 'delete-product')) {

        //If its asked to delete the product then continue

        if(isset($_GET['product_id'])) {

           
            $pmapper->deleteProduct($_GET['product_id']);
            header("Location: ../views/dashboard.php?action=view-products");
        }
    } 
    // If the action is edit-product then continue;
    else if(isset($_GET['action']) && ($_GET['action'] == 'edit-product')){

        if(isset($_GET['product_id'])){

            // Get id of product and send the user at editing page;
            $prodId = $_GET['product_id'];
            header("Location: ../views/edit-product.php?action=edit&product_id=$prodId");
        }
    }

    // If the action is delete-user then proceed
    else if(isset($_GET['action']) && ($_GET['action'] == 'delete-user')) {

        if(isset($_GET['user-id']) && (is_numeric($_GET['user-id']))) {
            // if the user that is being deleted is the admin itself, then delete and logout
            if($user['id'] == $_GET['user-id']){
                $mapper->deleteUser($_GET['user-id']);
                header("Location: ../views/logout.php");
            }else {
                $cartmapper = new CartMapper();
                $cartmapper->deleteUserCart($_GET['user-id']);
                $mapper->deleteUser($_GET['user-id']);
                header("Location: ../views/dashboard.php?action=view-users");
            }
            
        }
    } 
    
    // if the action is to make the user admin the proceed
    else if(isset($_GET['action']) && ($_GET['action'] == 'make-admin')){
        if(isset($_GET['user-id']) && (is_numeric($_GET['user-id']))){
            $mapper->makeAdmin($_GET['user-id']);
            header("Location: ../views/dashboard.php?action=view-users");
        }
    } 
    // if the action is to remove the user from admin then proceed
    else if(isset($_GET['action']) && ($_GET['action'] == 'remove-admin')){
        if(isset($_GET['user-id']) && (is_numeric($_GET['user-id']))){
            $mapper->removeAdmin($_GET['user-id']);
            header("Location: ../views/dashboard.php?action=view-users");
        }
    } 
    // if the action is edit user then proceed
    else if(isset($_GET['action']) && ($_GET['action'] == 'edit-user')){
        $user_id = $_GET['user-id'];
        header("Location: ../views/edit-user.php?action=edit-user&user-id=$user_id");
    }   
    // if the action is delete-slider-img then proceed
    else if(isset($_GET['action']) && $_GET['action'] == 'delete-slider-img'){
        if(isset($_GET['img-id']) && (is_numeric($_GET['img-id']))) {
            $img = $pmapper->getSliderImage($_GET['img-id']);

            $pmapper->deleteFromSlider($_GET['img-id']);
            header("Location: ../views/dashboard.php?action=add-slider-images");
        }
    }
    else if(isset($_GET['action']) && $_GET['action'] == "remove-from-cart"){
        if(isset($_GET['product_id'])){
            $cartmapper = new CartMapper();
            $cartmapper->deleteProductFromCart($_GET['product_id'], $_GET['user_id'], $_GET['size']);
            header("Location: ../views/cart.php");
        }
    }
}
else if(isset($_GET['action']) && $_GET['action'] == "remove-from-cart"){
    if(isset($_GET['product_id'])){
        $cartmapper = new CartMapper();
        $cartmapper->deleteProductFromCart($_GET['product_id'], $_GET['user_id'], $_GET['size']);
        header("Location: ../views/cart.php");
    }
}
// if not logged in or admin then change location to index
else {
    header("Location: ../views/index.php");
}