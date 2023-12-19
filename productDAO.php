<?php

require_once("connection.php");
require_once("Product.php");

class productDAO {
    private $db;
    public function __construct(){
        $this-> db = Database::getInstance()->getConnection();
    }

    public function get_products(){
        $query="SELECT * FROM product ORDER BY RAND()";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ProductsData = $stmt -> fetchAll();
        $Products = array();
        foreach($ProductsData as $P){
            $Products[] = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
            
        }
        return $Products;
    }

    public function insert_product($product){
        $query= "INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk) 
        VALUES ('".$product->getProd_name()."',".$product->getBar_code().",'".$product->getImg()."',
                ".$product->getsell_price().",".$product->getfinal_price().",".$product->getOffer_price().",
                '".$product->getProd_desc()."',".$product->getMin_quant().",".$product->getStock_quant().",
                ".$product->getCategory().")";
                echo $query;
                $stmt= $this->db->query($query);
                $stmt -> execute();

    }

    public function update_product($product){
        $query= "UPDATE product SET prod_name= '".$product->getProd_name()."', bar_code= ".$product->getBar_code().",
                 img= '".$product->getImg()."', sell_price= ".$product->getsell_price().", final_price= ".$product->getfinal_price().",
                 offer_price= ".$product->getOffer_price().", prod_desc= '".$product->getProd_desc()."', min_quant= ".$product->getMin_quant().",
                 stock_quant= ".$product->getStock_quant().", category= ".$product->getCategory()." WHERE ref= ".$product->getRef()."  ";
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    
    public function delete_product($id){
        $query= "UPDATE product SET bl=0 WHERE ref= $id";
        $stmt= $this->db->query($query);
        $stmt -> execute();
    }

}

?>