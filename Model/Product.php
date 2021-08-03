<?php
require_once('DAO.php');
class Product extends DAO
{
    public $id;
    public $name;
    public $price;
    public $image;
    public $des;


    public function __construct()
    {
        parent::__construct();
    }

    public function getProduct()
    {
        $sql = 'SELECT * from product';
        $result = mysqli_query($this->conn, $sql);
        if (is_null($result))
            return 'No results';
        else {
            $data = [];
            while ($row = mysqli_fetch_array($result, 1)) {
                $data[] = $row;
            }
        }
        $this->disconnect();
        return $data;
    }

    public function createProduct($data)
    {
        $name = $data['name'];
        $price = $data['price'];
        $des = $data['des'];
        $image = "upload_image/" . $_FILES['image']['name'];
        $sql = "INSERT INTO product (`name`, `price`, `image`, `des`) VALUES ('$name', '$price','$image', '$des')";
        $result = $this->conn->query($sql);
        if ($result) {
            $last_id = $this->conn->insert_id;
            move_uploaded_file($_FILES['image']['tmp_name'], './View/' . $image);
            $response = json_encode(array("statusCode" => 200, "last_id" => $last_id));
        } else
            $response = json_encode(array("statusCode" => 404));
        echo $response;
    }

    public function updateProduct($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];
        $des = $data['des'];
        if (($_FILES['image']['name']) == "") {
            $image = $data['imageUrl'];
        } else {
            $image = "upload_image/" . $_FILES['image']['name'];
        }
        $sql = "UPDATE product SET name='$name', price='$price', image= '$image', des='$des' WHERE id = '$id' ";
        $result = $this->conn->query($sql);
        if ($result) {
            move_uploaded_file($_FILES['image']['tmp_name'], './View/' . $image);
            $response = json_encode(array("statusCode" => 300));
        } else
            $response = json_encode(array("statusCode" => 500));
        echo $response;
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id='$id'";
        $this->conn->query($sql);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM product WHERE id='$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_row();
    }
}
