<?php

require_once("connection.php");
require_once("Order.php");

class orderDAO {
    private $db;
    public function __construct(){
        $this-> db = Database::getInstance()->getConnection();
    }

    public function get_order(){
        $query="SELECT * FROM orders";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $OrdersData = $stmt -> fetchAll();
        $Orders = array();
        foreach($OrdersData as $O){
            $Orders[] = new Order($O["id"], $O["creation_date"], $O["shipping_date"], $O["delivery_date"], $O["total_price"], $O["bl"], $O["client_id"]);

        }
        return $Orders;
    }

    public function add_order($order){
        $query= "INSERT INTO orders (creation_date, shipping_date, delivery_date, total_price, client_id) 
        VALUES ('".$order->getCreation_date()."','".$order->getShipping_date()."','".$order->getDelivery_date()."',
                ".$order->getTotal_price().",".$order->getClient_id()." )";
        echo $query;
        $stmt= $this->db->query($query);
        $stmt -> execute();
    }

    public function update_order($order){
        $query= "UPDATE orders SET shipping_date= '".$order->getShipping_date()."', delivery_date= '".$order->getDelivery_date()."',
                total_price= ".$order->getTotal_price()." WHERE id= ".$order->getId()." ";
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }
    public function valid_order($id){
        $query= "UPDATE orders SET bl = 1 WHERE id=$id ";
                echo $query;
                $stmt= $this->db->query($query);
                $stmt -> execute();

    }

    public function unverify_client($id){
        $query= "UPDATE orders SET bl = 0 WHERE id=$id ";
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    
    public function delete_order($id){
        $query= "DELETE FROM orders WHERE id=$id ";
        $stmt= $this->db->query($query);
        $stmt -> execute();
    }

}

?>