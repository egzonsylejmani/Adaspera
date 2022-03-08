<?php 
class addSlider{
    private $image_id;
    private $image;

    public function __construct($image_id,$image){
        $this->image_id=$image_id;
        $this->image=$image;
    
    }

    public function getImageId(){
        return $this->image_id;
    }

    public function getImage(){
        return $this->image;
    }
}
?>