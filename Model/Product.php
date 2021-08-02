<?php
require_once('DAO.php');
class Product extends DAO{
    public $id;
    public $name;
    public $price;
    public $image;
    public $des;


    public function __construct(){
        parent::__construct();
    }

    public function updateProduct($data){
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];
        $des = $data['des'];
        $image = "upload_image/".$data['image']['name'];
        $sql = "UPDATE product SET name='$name', price='$price', image= '$image', des='$des' WHERE id = '$id' ";
        $result = $this->conn->query($sql);
        if($result){
            move_uploaded_file($_FILES['image']['tmp_name'], './View/'.$image);
            $response = json_encode(array("statusCode"=>300));
        }else
            $response = json_encode(array("statusCode"=>500));
        echo $response;
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM product WHERE id='$id'";
        $this->conn->query($sql);
    }

    public function findById($id){
        $sql = "SELECT * FROM product WHERE id='$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_row();
    }
}