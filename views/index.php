<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../businessLogic/Database.php';
include_once '../businessLogic/UserMapper.php';
include_once '../businessLogic/ProductMapper.php';
include_once '../components/header.php';

$umapper = new UserMapper();
$mapper = new ProductMapper();
$slider_images = $mapper->getSliderImages();
$products = $mapper->getProductsByCategoryAndByLimit("New",4);
$category = "Men";
$products_based_on_category = $mapper->getProductsByCategoryAndByLimit($category,8);

?>

<main>
    <div class="home-banners">
        <div class="home-banners-images">
            <img src="<?php echo $slider_images[0]["image"]?>" alt="banner">
            <div class="home-banners-paragraph">


                <p>SALE</p>
                <p>UP TO 50%</p>
                <p>OFF ALL SALE ITEMS</p>

            </div>
        </div>

    </div>

    <div class="slideshow-container">
        <div class="slideshow-container">
            <?php for($i=0; $i < count($slider_images); $i = $i + 1) {
                if($i == 0) {
                  continue;
                }
                ?>
            <div class="mySlides fade">
                <img src="<?php echo $slider_images[$i]['image']?>" style="width:100%">
            </div>
            <?php }?>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
    <br>

    <div style="text-align:center;padding: 0 0 64px 0;">
        <?php 
         $j =0;
        for($i=0; $i < count($slider_images); $i = $i + 1) {
           
                if($i == 0) {
                  continue;
                }else{
                    $j+=1;
                }
                ?>
        <span class="dot home-page" onclick="currentSlide(<?php echo $j?>)"></span>
        <?php }?>

    </div>


    <div class="productlist-container">
        <div class="products-container">
            <div class="products-header" style="text-align: center;">
                <h1 style="font-size: 2rem;">Shop some new products:</h1>
            </div>

        </div>
        <div class="productlist-products ">
            <?php foreach($products as $product){
                  $pid = $product['product_id'];
                ?>
            <div class="product">
                <div class="image-container">

                    <a href="<?php echo "product-page.php?pid=$pid" ?>">
                        <img src="<?php echo $product["image"];?>">
                        </img>

                    </a>

                    <div class="product-details">
                        <a><?php echo $product["name"];?></a>
                        <p> <?php echo $product["price"];?> &euro;</p>
                    </div>
                </div>

            </div>
            <?php } 
                ?>
        </div>
        <div class="productlist-container">
            <div class="products-container">
                <div class="products-header" style="text-align: Right;">
                    <h1 style="font-size: 4rem;"><?php echo $category;?></h1>
                </div>

            </div>
            <div class="productlist-products">
                <?php foreach($products_based_on_category as $product){
                  $pid = $product['product_id'];
                ?>
                <div class="product">
                    <div class="image-container">
                        <a href="<?php echo "product-page.php?pid=$pid" ?>">
                            <img src="<?php echo $product["image"];?>">
                            </img>

                        </a>

                        <div class="product-details">
                            <a><?php echo $product["name"];?></a>
                            <p> <?php echo $product["price"];?> &euro;</p>
                        </div>
                    </div>

                </div>
                <?php } 
                ?>
            </div>


        </div>
</main>
<script src="../assets/script.js"></script>


<?php
include_once '../components/footer.php'; ?>