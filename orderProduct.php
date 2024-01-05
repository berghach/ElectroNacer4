<?php

include("config.php");

class OrderProduct{
    private $order_id;
    private $Product_id;
    private $quantity;
    public function __construct($order_id, $Product_id, $quantity){
        $this->order_id = $order_id;
        $this->Product_id = $Product_id;
        $this->quantity = $quantity;
    }
    public function get_order_id(){
        return $this->order_id;
    }
    public function get_product_id(){
        return $this->Product_id;
    }
    public function get_quantity(){
        return $this->quantity;
    }
}

class orderProductDAO{
    private $db;
    public function __construct(){
        $this-> db = Database::getInstance()->getConnection();
    }
    public function get_ordProducts($order_id){
        $query="SELECT * FROM orderproduct WHERE order_id=$order_id";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ordProducData = $stmt -> fetchAll();
        $OrdProduct = array();
        foreach($ordProducData as $OP){
            $OrdProduct[] = new OrderProduct($OP["order_id"], $OP["product_ref"], $OP["quantity"]);
            
        }
        return $OrdProduct;
    }

    public function insert_order_product($order){
        $query= "INSERT INTO ";
    }
}

?>