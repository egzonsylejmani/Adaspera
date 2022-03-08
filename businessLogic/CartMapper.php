<?php 

require_once "Database.php";

class CartMapper extends DatabaseConfig {
    private $connection;
    private $query;

    public function __construct(){
        $this->connection = $this->getConnection();
    }

    public function insertToCart($user_id, $product_id, $size){
        $this->query = "insert into cart (user_id, product_id, size) 
            values (:user_id, :product_id, :size)";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":product_id", $product_id);
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":size", $size);

        $statement->execute();
    }


    public function getCart(){
        $this->query = "select * from cart";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $resut = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $resut;
    }


    public function getCartProducts($user_id){
        $this->query = "select * from cart where user_id=:user_id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":user_id", $user_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteProductFromCart($product_id, $user_id, $size){
        $this->query = "delete from cart where product_id=:product_id and user_id=:user_id and size=:size";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":product_id", $product_id);
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":size", $size);

        $statement->execute();
    }

    public function deleteUserCart($user_id){
        $this->query = "delete from cart where user_id=:user_id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":user_id", $user_id);
        $statement->execute();
    }
}