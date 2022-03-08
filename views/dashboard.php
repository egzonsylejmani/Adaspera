<?php 
    include '../components/header.php';
    include_once '../businessLogic/UserMapper.php';
    include_once '../businessLogic/ProductMapper.php';
    include_once '../businessLogic/Admin.php';

    if(!isset($_SESSION['is_logged_in']) || $_SESSION['role'] == 0){
        header("Location: index.php");
    }
    else if (isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 1){
        $mapper =  new UserMapper();
        $userList = $mapper->getAllUsers();
        $user = $mapper->getUserByEmail($_SESSION['email']);
        $pmapper = new ProductMapper();
        $productList = $pmapper->getAllProducts();

        $sliderImg = $pmapper->getSliderImages();
    ?>

<main id='main'>

    <?php if(isset($_GET['action']) == false){?>
    <div class="dashboard-container">
        <div class="dashboard-panel wrapper">
            <div class="greet">
                <h3>Welcome to the administrator panel, <?= $user['first_name']?></h3>
            </div>
            <div class="square">
                <img src="../images/icons/plus-sign.svg" alt="">
                <a href="dashboard.php?action=add-product">Add Product</a>
            </div>
            <div class="square">
                <img src="../images/icons/box.svg" alt="">
                <a href="dashboard.php?action=view-products">All Products</a>
            </div>
            <div class="square">
                <img src="../images/icons/users.svg" alt="">
                <a href="dashboard.php?action=view-users">All Users</a>
            </div>

            <div class="square">
                <img src="../images/icons/photo.svg" alt="">
                <a href="dashboard.php?action=add-slider-images">Add Slider images</a>
            </div>

        </div>
    </div>

    <?php } else if (isset($_GET['action']) && $_GET['action'] == 'view-products'){ ?>
    <div class="db-container">
        <table class="db-table">
            <thead>
                <tr>
                    <th colspan="10" style="font-size: 20px;">Products</th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Product ID</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Color</th>
                    <th>Image</th>
                    <th>Sizes Available</th>
                    <th>Added by</th>


                    <th colspan="2">Update</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($productList as $product){
                            for($i =0; $i < count($userList); $i++){
                                if($product['admin_id'] == $userList[$i]['id']){
                                    $product["admin_id"] = $userList[$i]['first_name'];
                                }
                            }
                        ?>
                <tr>
                    <td>
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo $product['product_id']; ?>
                    </td>
                    <td>
                        <?php echo $product['price']; ?> &euro;
                    </td>
                
                    <td>
                        <?php echo $product['category']; ?>
                    </td>
                    <td>
                        <?php echo $product['color']; ?>
                    </td>
                    <td>
                        <?php echo $product['image']; ?>
                    </td>
                    <td>
                        <?php echo $product['sizes_available']; ?>
                    </td>
                    <td>
                        <?php echo $product['admin_id']; ?>
                    </td>
                    <td>
                        <a href="<?php echo "../businessLogic/Modifications.php?action=delete-product&product_id=".$product['product_id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this product?');">Delete
                        </a>
                    </td>

                    <td>
                        <a
                            href="<?php echo "../businessLogic/Modifications.php?action=edit-product&product_id=".$product['product_id']; ?>">Edit
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php } else if (isset($_GET['action']) && $_GET['action'] == 'add-product'){ 
            if(isset($_GET['upload']) && $_GET['upload'] == 'success'){
                echo '<script>alert("The product was successfully added.")</script>';
            }
            else if (isset($_GET['upload']) && $_GET['upload'] == 'error'){
                echo '<script>alert("The product could not be added.")</script>';
            }?>
    <div class="edit-product-main">
        <form method="POST" action="../businessLogic/Upload.php" class="edit-product-card">
            <h2>Add Product</h2>
            <hr class="divider">
            <a>Product Name</a>
            <input type="text" name="name" value="" required>
            <a>Product ID</a>
            <input type="text" name="product_id" value="">
            <a>Price</a>
            <input type="number" step="any" name="price" value="" required>
            <a>Category</a>

            <textarea name="category" value="" required></textarea>
            <a>Image</a>
            <input type="text" name="image" value="" required>
            <a>Color</a>
            <input type="text" name="color" value="" required>
            <a>Sizes Available</a>

            <input type="text" name="sizes_available" value="" required>

            <input class="button" type="submit" style=" background: black;color: #ffff;" name="add-product-btn"
                value="Add Product">
            <a href="dashboard.php">Cancel</a>
        </form>
    </div>
    <?php } else if(isset($_GET['action']) && $_GET['action'] == 'view-users') { ?>
    <div class="db-container">
        <table class="db-table">
            <thead>
                <tr>
                    <th colspan="10">Users</th>
                </tr>
                <tr class="users-email-col">
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th colspan="3">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($userList as $user){ ?>
                <tr class="users-email-col">
                    <td>
                        <?php echo $user['first_name']; ?>
                    </td>
                    <td>
                        <?php echo $user['last_name']; ?>
                    </td>
                    <td>
                        <?php echo $user['email']; ?>
                    </td>
                    <td><a href="<?php echo "../businessLogic/modifications.php?action=delete-user&user-id=".$user['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this user?');">Delete</a></td>
                    <?php if($user['is_admin'] == 1) {?>
                    <td><a href="<?php echo "../businessLogic/modifications.php?action=remove-admin&user-id=".$user['id']; ?>"
                            onclick="return confirm('Are you sure you want to demote this user?');">Remove Admin</a>
                    </td>
                    <?php } else { ?>
                    <td><a href="<?php echo "../businessLogic/modifications.php?action=make-admin&user-id=".$user['id']; ?>"
                            onclick="return confirm('Are you sure you want to promote this user to admin?');">Promote to
                            admin</a></td>
                    <?php } ?>
                    <td><a
                            href="<?php echo "../businessLogic/modifications.php?action=edit-user&user-id=".$user['id']; ?>">Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <?php } else if (isset($_GET['action']) && $_GET['action'] == 'add-slider-images'){ 
        if(isset($_GET['upload']) && $_GET['upload'] == 'success'){
            echo '<script>alert("Photo has been added succesfully to the slider")</script>';
        }?>
    <div class="edit-product-main">
        <form method="POST" action="../businessLogic/Upload.php" class="edit-product-card">
            <a>Image ID</a>
            <input type="text" name="image_id" value="" required>
            <a>Image Link</a>
            <input type="text" name="image" value="">
            <input class="button" type="submit" name="add-slider-img" value="Add photo">
            <a href="dashboard.php">Cancel</a>
        </form>
    </div>
    <div class="db-container">
        <table class="db-table">
            <thead>
                <tr>
                    <th colspan="3">Slider Images</th>
                </tr>
                <tr>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sliderImg as $img){ ?>
                <tr>
                    <td>
                        <img style="max-width: 100%;" src="<?php echo $img['image']; ?>" alt="">
                    </td>

                    <td><a href="<?php echo "../businessLogic/modifications.php?action=delete-slider-img&img-id=".$img['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this photo?');">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php } ?>
    <?php } else {
        echo "Error 404";
} include '../components/footer.php'; ?>