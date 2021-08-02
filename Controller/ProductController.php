<?php

class ProductController{

    public function edit(){
        $id = $_POST['id'];
        require_once('Model/Product.php');
        $product = new Product();
        echo json_encode([
            'data' => $product->findById($id)
        ]);
    }

    public function delete(){
        $id = $_POST['id'];
        require_once('Model/Product.php');
        $product = new Product();
        $product->deleteProduct($id);
    }

    public function add(){
        require('Model/Product.php');
        $data = $_POST;
        $product = new Product();
        if(empty($data['id'])){
            //code for add product
        }else
            $product->updateProduct($data);
    }
}
