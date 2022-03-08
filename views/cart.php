<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../components/header.php';
include_once '../businessLogic/CartMapper.php';
include_once '../businessLogic/UserMapper.php';
include_once '../businessLogic/ProductMapper.php';

if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1){

$cmapper = new CartMapper();
$umapper = new UserMapper();
$cartlist = $cmapper->getCart();
$loggeduser = $umapper->getUserByEmail($_SESSION['email']);
$cartProducts = $cmapper->getCartProducts($loggeduser['id']);
$pmapper = new ProductMapper();

$product_recommendations = $pmapper->getProductsByLimit(4);
global $productsInUserCart;
$productsInUserCart = array();

for($i = 0; $i < count($cartProducts); $i = $i + 1){
    $prod = $pmapper->getProductsById($cartProducts[$i]['product_id']);
    $prod['size'] = $cartProducts[$i]['size'];
    $productsInUserCart[$i] = [$prod];
}
$total_cart_products = count($productsInUserCart);

}else{
    $pmapper = new ProductMapper();

    $product_recommendations = $pmapper->getProductsByLimit(4);
}
 ?>
<main style="
    margin-bottom: 100px;
">

    <?php if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1)
{
    if($total_cart_products == 0){
            ?>
    <div class="cart-container">
        <div class="empty-cart" style="display: block">
            <div class="empty-cart-msg">
                <span>Your shopping bag
                    is empty

                    - it's time to fill it up now!</span>
            </div>
            <div class="productlist-container">
                <div class="products-container">
                    <div class="products-header" style="text-align: center;">
                        <h1 style="font-size: 2rem;">Inspirations for you:</h1>
                    </div>

                </div>
                <div class="productlist-products ">
                    <?php foreach($product_recommendations as $product){
                            $pid = $product['product_id'];
                            ?>

                    <div class="product">
                        <div class="image-container">
                            <a href='<?php echo "product-page.php?pid=$pid" ?>'>
                                <img src="<?php echo $product["image"];?>">
                                </img>

                            </a>

                            <div class="product-details">
                                <a><?php echo $product["name"];?></a>
                                <p> <?php echo $product["price"];?> €</p>
                            </div>
                        </div>

                    </div>
                    <?php } ?>


                </div>


            </div>
        </div>

        <?php   }
?>
        <?php if($total_cart_products > 0) {?>
        <div class="not-empty-cart clearfix">
            <div class="cart-rows">
                <div class="cart-headline">
                    <h5>Your shopping bag (<span class="shopping-bag-items-count"><?php echo $total_cart_products; ?>
                            item</span>)</h5>
                </div>

                <?php  foreach($productsInUserCart as $product){
                $pid = $product[0]['product_id'];
                
                ?>


                <div class="cart-item">
                    <div class="cart-image">
                        <a href='<?php echo "product-page.php?pid=$pid" ?>'>
                            <img src="<?php echo $product[0]["image"];?>"></img>
                        </a>
                    </div>
                    <div class="item-attributes">
                        <div class="cart-remove">
                            <h5 class="cart-bold"><?php echo $product[0]["name"];?></h5>
                            <a href="<?php echo "../businessLogic/modifications.php?action=remove-from-cart&product_id=".$product[0]['product_id']."&size=".$product[0]["size"]."&user_id=".$loggeduser["id"]; ?>"
                                class="cart-remove-item">
                                <img style="height: 12px;position: relative;margin-top: 5px;"
                                    src="../assets/icon-close-4.svg">
                            </a>

                        </div>
                        <p>Size: <?php echo $product[0]["size"] ?></p>
                        <p>Colour: <?php echo $product[0]["color"];?></p>
                        <p>Quantity: 1</p>
                        <p class="cart-price cart-bold"><?php echo $product[0]["price"];?> &euro;</p>
                    </div>

                </div>
                <?php } ?>






                <div class="summary-container">
                    <div class="cart-summary">
                        <div class="cart-summary-child">
                            <h3>Order Summary</h3>

                            <div class="cart-summary-row">
                                <p>SubTotal</p>
                                <p class="subtotal-price">0 €</p>
                            </div>
                            <div class="cart-summary-row">
                                <p>Standard Delivery
                                </p>
                                <p class="delivery-amount">2.99 €</p>

                            </div>
                            <div class="cart-summary-row">
                                <p><strong style="font-size: 16px"> Total</strong> <span style="font-size: 12px;">incl.
                                        VAT</span></p>
                                <p class="total-price">0 €</p>
                            </div>

                            <div class="btn-checkout">
                                <a href="">
                                    Proceed to checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php } ?>

            <?php   }else{          
        ?>
            <div class="empty-cart-msg">
                <span>You are not logged in

                    - Please log in</span>
            </div>
            <div class="productlist-container">
                <div class="products-container">
                    <div class="products-header" style="text-align: center;">
                        <h1 style="font-size: 2rem;">Inspirations for you:</h1>
                    </div>

                </div>
                <div class="productlist-products ">
                    <?php foreach($product_recommendations as $product){
                            $pid = $product['product_id'];
                            ?>

                    <div class="product">
                        <div class="image-container">
                            <a href='<?php echo "product-page.php?pid=$pid" ?>'>
                                <img src="<?php echo $product["image"];?>">
                                </img>

                            </a>

                            <div class="product-details">
                                <a><?php echo $product["name"];?></a>
                                <p> <?php echo $product["price"];?> €</p>
                            </div>
                        </div>

                    </div>
                    <?php } ?>


                </div>


            </div>
            <?php } ?>
        </div>
</main>
<script src="../assets/script.js"></script>
<?php
include_once '../components/footer.php'; ?>