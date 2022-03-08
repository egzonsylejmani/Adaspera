<?php

class Product{
    private $product_id;
    private $name;
    private $price;
    private $category;
    private $image;
    private $color;
    private $admin;
    private $sizes_available;

    public function __construct($product_id, $name, $price,$category,$image, $color, $admin_id, $sizes_available){
        $this->product_id=$product_id;
        $this->name=$name;
        $this->price = $price;
        $this->category=$category;
        $this->image=$image;
        $this->color=$color;
        $this->admin = $admin_id;
        $this->sizes_available = $sizes_available;
    }

    public function getProductId(){
        return $this->product_id;
    }

    public function getName(){
        return $this->name;
    }
       public function getColor(){
        return $this->color;
    }

    public function getPrice(){
        return $this->price;
    }


    public function getCategory(){
        return $this->category;
    }
    public function getImage(){
        return $this->image;
    }
    public function getAdminId(){
        return $this->admin;
    }
    public function getSizesAvailable(){
        return $this->sizes_available;
    }
}