<?php 

require_once "Database.php";

class ProductMapper extends DatabaseConfig {
    private $connection;
    private $query;

    public function __construct(){
        $this->connection = $this->getConnection();
    }

    public function insertProduct($product){
        $this->query = "insert into products (product_id, name, price, category, image, color, admin_id, sizes_available) 
            values (:productID, :name, :price, :category, :image, :color, :admin_id, :sizes_available)";
        $statement = $this->connection->prepare($this->query);
        $product_id = $product->getProductID();
        $name = $product->getName();
        $price = $product->getPrice();
        $category = $product->getCategory();
        $image = $product->getImage();
        $color = $product->getColor();
        $sizes_available = $product->getSizesAvailable();
        $admin = $product->getAdminId();

        $statement->bindParam(":productID", $product_id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':category', $category);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':color', $color);
        $statement->bindParam(':admin_id', $admin);
        $statement->bindParam(':sizes_available', $sizes_available);

        $statement->execute();
        return true;
    }

    public function getAllProducts(){
        $this->query = "select * from products";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProductsByLimit($number){
        $this->query = "select * from products limit $number";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    // return products of the category given as argument
    public function getProductsByCategory($category){
        $this->query = "select * from `products` where category =:category";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":category", $category);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getProductsByCategoryAndByLimit($category,$number){
        $this->query = "select * from `products` where category =:category limit $number";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":category", $category);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

     public function getProductsByCategoryAndByLimitAndNotSameID($category,$product_id,$number){
        $this->query = "select * from `products` where category =:category and product_id !=:product_id limit $number";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":category", $category);
        $statement->bindParam(":product_id", $product_id);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getProductsById($id){
        $this->query = "select * from products where product_id=:product_id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":product_id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteProduct($product_id){
        $this->query = "delete from products where product_id=:product_id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":product_id", $product_id);
        $statement->execute();
    }

    public function updateProduct($product_id, $name, $price, $category, $image, $color, $sizes_available){
        $this->query = "update products set name=:name, price=:price, category=:category, image=:image, color=:color, sizes_available=:sizes_available where product_id=:product_id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":product_id", $product_id);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":category", $category);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":color", $color);
        $statement->bindParam(":sizes_available", $sizes_available);
        $statement->execute();
    }



    public function insertIntoSlider($image){
        $this->query = "insert into slider_images (id,image) 
            values (:id,:image)";
            $statement = $this->connection->prepare($this->query);
            $image_id = $image->getImageId();
            $image = $image->getImage();
            $statement->bindParam(":id", $image_id);
            $statement->bindParam(":image", $image);
            $statement->execute();
            return true;
    }

    public function deleteFromSlider($id){
        $this->query = "delete from slider_images where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function getSliderImages(){
        $this->query = "select * from slider_images";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
 public function getSliderImage($id){
        $this->query = "select * from slider_images where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}    