<?php

include("config.php");

class OrderProduct{
    private $order_id;
    private $Product_id;
    private $quantity;
    private $price;
    public function __construct($order_id, $Product_id, $quantity, $price){
        $this->order_id = $order_id;
        $this->Product_id = $Product_id;
        $this->quantity = $quantity;
        $this->price = $price;
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
    public function get_price(){
        return $this->price;
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
            $OrdProduct[] = new OrderProduct($OP["order_id"], $OP["product_ref"], $OP["quantity"], $OP["price"]);
            
        }
        return $OrdProduct;
    }

    public function insert_order_product(OrderProduct $order_product){
        $query= "INSERT INTO orderproduct (order_id, product_ref, quantity, price)
                VALUES (:order, :product, :quatity, :price)";
        $stmt= $this->db->prepare($query);
        $O = $order_product->get_order_id();
        $P = $order_product->get_product_id();
        $Q = $order_product->get_quantity();
        $Pr = $order_product->get_price();
        $stmt->bindParam(":order", $O, PDO::PARAM_INT);
        $stmt->bindParam(":product", $P, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $Q, PDO::PARAM_INT);
        $stmt->bindParam(":price", $Pr, PDO::PARAM_STR);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function update_order_product(OrderProduct $order_product){
        $stmt = $this->db->prepare("UPDATE orderproduct SET quantity = :newQuantity , price = :newPrice
                                    WHERE order_id = :order AND product_ref = :product");
        $O = $order_product->get_order_id();
        $P = $order_product->get_product_id();
        $NQ = $order_product->get_quantity();
        $NPr = $order_product->get_price();
        $stmt->bindParam(":order", $O, PDO::PARAM_INT);
        $stmt->bindParam(":product", $P, PDO::PARAM_INT);
        $stmt->bindParam(":newQuantity", $NQ, PDO::PARAM_INT);
        $stmt->bindParam(":newPrice", $NPr, PDO::PARAM_STR);
        $stmt->execute();
        if( $stmt->rowCount() != 0){
            return true;
        }else{
            return false;
        }
    }
}

?>