<?php

class ProductController{
    public function all(){
        //gọi model lấy data
        require_once('Model/Product.php');
        $product = new Product();
        $products = $product->getProduct();

        //gọi view hiển thị. chưa hẳn là view, vì muốn truyền tham số #products sang view nên gọi qua cái lớp này
        require_once('View/templates/admin/ProductView.php');
        $productView = new ProductView();
        $productView->showProducts($products);
    }


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
            $product->createProduct($data);
        }else
            $product->updateProduct($data);
    }
}
