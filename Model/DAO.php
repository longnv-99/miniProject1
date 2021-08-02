<?php
    define('HOST','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DATABASE','miniproject1');

    class DAO{
        protected $conn = NULL;
        function __construct()
        {
            if(!isset($conn)){
                try{
                    $this->conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
                }catch(Exception $e){
                    die($e->getMessage());
                }
            }
        }

        function disconnect(){
            $this->conn->close();
        }
    }
?>
