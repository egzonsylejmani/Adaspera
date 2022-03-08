<?php 
    include_once '../businessLogic/ProductMapper.php';
    include_once '../businessLogic/Product.php';
    include '../components/header.php';

    if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) 
        && $_SESSION['is_logged_in'] == 1 && $_SESSION['role'] == 1){

        $errors = [];
        $mapper = new ProductMapper();
        if(isset($_GET['action']) && $_GET['action'] == 'edit'){
            $product = $mapper->getProductsById($_GET['product_id']);
        }  

        if(isset($_POST['update-product-btn'])){
            $product_id = $_POST['product_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $color = $_POST['color'];
            $image = $_POST['image'];
            $category = $_POST['category'];
            $sizes_available = $_POST["sizes_available"];
           
            $mapper->updateProduct($product_id, $name, $price,$category,$image, $color, $sizes_available);
            header("Location: dashboard.php?action=view-products");
        }
?>  
    <div class="edit-product-main">
        <img src="<?= $product['image']?>">
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="edit-product-card">
            <input readonly type="text" name="product_id" value="<?= $product['product_id'] ?>">
            <input type="text" name="name" value="<?= $product['name'] ?>">
            <input type="number" name="price" value="<?= $product['price'] ?>">
            <input type="text" name="category" value="<?= $product['category'] ?>">
            <input type="text" name="image" value="<?= $product['image'] ?>">
            <input type="text" name="color" value="<?= $product['color'] ?>">
            <input type="text" name="sizes_available" value="<?= $product['sizes_available'] ?>">


            <!-- <select name="cat">
                <option value="<?= $product['kategoria']?>"><?= $product['kategoria']?></option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category['emri']?>"><?= $category['emri']?></option>
                <?php endforeach; ?>
            </select> -->
            <input class="button" type="submit" name="update-product-btn" value="Ruaj ndryshimet">
            <a href="dashboard.php?action=view-products">Cancel</a>
        </form>
    </div>
<?php } else {
    header("Location: ../views/index.php");
}
?>

<?php include '../components/footer.php'?>