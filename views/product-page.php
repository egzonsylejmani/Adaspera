<?php
include_once '../components/header.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../businessLogic/ProductMapper.php';
include_once '../businessLogic/Product.php';
include_once '../businessLogic/UserMapper.php';
include_once '../businessLogic/CartMapper.php';

$pmapper = new ProductMapper();
$mapper = new UserMapper();
$cmapper = new CartMapper();

$pid=$page_query;
$product = $pmapper->getProductsById($pid);
$sizes_available = $product["sizes_available"];
$sizes = explode(",", $sizes_available);
$product_id_recomm = $product["product_id"];
$category_recommendation = $product["category"];
$product_recommendations = $pmapper->getProductsByCategoryAndByLimitAndNotSameID($category_recommendation,$product_id_recomm,4);




if(isset($_SESSION['is_logged_in'])==1){
    $userCart = $mapper->getUserByEmail($_SESSION['email']); 
    $cartProducts = $cmapper->getCartProducts($userCart['id']);
    if($cartProducts){
    ?>
<script>
   var productsArray = <?php echo json_encode($cartProducts);  ?>;
</script>
    <?php
    }
    
}
?>



  <!-- <div class="describe-content ">
    <br>

    <h4>The best comes at the end: <strong> &nbsp;20% EXTRA off</strong>&nbsp;in the sale!* Code: <strong>&nbsp;20TOP
      </strong></h4>
  </div> -->

  <section class="product-page product-page-body">

    <div class="product-image">
        <img src="<?php echo $product["image"];?>" class="product-image-img" />
    
    </div>


    <div class="right-side">
      <div class="name-product">
        <span>
          <h3><?php echo $product["name"]?></h3>
        </span>
        <span>
          <h3><?php echo $product["price"]?> &euro;</h3>
        </span>

      </div>
      <br>

      <div class="colour">
        <span>
          <p style="font-weight: 700;">Color:</p>
        </span>
        <span><?php echo $product["color"];?></span>
      </div>

      <div class="size">
        <span>
            <p style="font-weight: 700;margin: 15px 0 15px 0;">Sizes</p>
        </span>

        <div class="size-row">
            <?php 
            foreach($sizes as $size){
            $size = trim($size);
            echo "<button style='background:#ffff' class='btn size-btn'> $size</button>";
            }
            ?>

        </div>
      </div>


    <?php 
      if(isset($_SESSION['is_logged_in']) == 1){
       ?> <div class="add-to-bag">
      
        <a href = "<?php echo "../businessLogic/Upload.php?action=add-to-cart&product_id=".$pid?>" class="add-to-cart-button">Add to bag</a>
      
      </div>
      <?php }else { ?>
       <a href ="account.php"><p > You have to be logged in to add to cart</p></a>
         <?php }?>
   
    
 </div>
  </section>
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


  

  <script src="../assets/script.js"></script>



<?php include '../components/footer.php';?>
 
