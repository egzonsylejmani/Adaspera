
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../components/header.php';
include '../businessLogic/Database.php';
include_once '../businessLogic/UserMapper.php';
include_once '../businessLogic/ProductMapper.php';
$umapper = new UserMapper();
$mapper = new ProductMapper();


$products_based_on_category = $mapper->getProductsByCategory($page_query);
?>
    <main>
        <div class="productlist-container">
            <div class="products-container">
                <div class="products-header">
                    <h1><?php echo $_GET["page"] ?></h1>
                </div>

            </div>
            <div class="productlist-products">
            <?php foreach($products_based_on_category as $product){
                 $pid = $product['product_id'];
                ?>
                <div class="product">
                    <div class="image-container">
                        <a href='<?php echo "product-page.php?pid=$pid" ?>'>
                            <img src="<?php echo $product["image"];?>">
                            </img>

                        </a>

                        <div class="product-details">
                            <a><?php echo htmlspecialchars($product['name']);?></a>
                            <p> <?php echo htmlspecialchars($product['price']);?> &euro;</p>
                        </div>
                    </div>

                </div>
                <?php } 
                ?>
                
            
            </div>


        </div>
    </main>


 <?php
include_once '../components/footer.php'; ?>