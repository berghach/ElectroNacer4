<?php

require_once("connection.php");
require_once("Product.php");
require_once("categoryDAO.php");
$category=new categoryDAO();

class productDAO {
    private $db;
    public function __construct(){
        $this-> db = Database::getInstance()->getConnection();
    }
    public function get_all_products(){
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


    public function get_products(){
        $query="SELECT * FROM product WHERE bl=1 ORDER BY RAND()";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ProductsData = $stmt -> fetchAll();
        $Products = array();
        foreach($ProductsData as $P){
            $Products[] = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
            
        }
        return $Products;
    }

    public function get_deleted_products(){
        $query="SELECT * FROM product WHERE bl=0";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ProductsData = $stmt -> fetchAll();
        $Products = array();
        foreach($ProductsData as $P){
            $Products[] = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
            
        }
        return $Products;
    }


    public function get_products_by_id($id){
        $query= "SELECT * FROM product WHERE ref = $id";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ProductData = $stmt -> fetchAll();
        foreach($ProductData as $P){
            $Product = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
        }
        return $Product;
    }
    public function get_products_by_alfa(){
        $query= "SELECT * FROM product ORDER BY prod_name";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ProductData = $stmt -> fetchAll();
        $products = array();
        foreach($ProductData as $P){
            $products[] = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
        }
        return $products;
    }

    public function get_products_high_stock(){
        $query= "SELECT * FROM product ORDER BY stock_quant DESC;";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ProductData = $stmt -> fetchAll();
        $products = array();
        foreach($ProductData as $P){
            $products[] = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
        }
        return $products;
    }
    public function get_products_by_category($c){
        $query= "SELECT * FROM product INNER JOIN category ON product.category_fk=category.id WHERE category.cat_name = '$c'";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ProductData = $stmt -> fetchAll();
        $products = array();
        foreach($ProductData as $P){
            $products[] = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
        }
        return $products;

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

// $d=30;
// $product = new productDAO();
// $products=$product-> get_products_high_stock();
//             echo '<div class="card-deck" style="margin: 50px;">';
//             foreach($products as $prod) {
//                 echo '<div class="card" style="background-color: rgb(169, 201, 223); ">';
//                 echo '<img class="card-img-top" src="./assets/pics_electro/'.$prod->getImg().'" alt="Card image cap">';
//                 echo '<div class="card-body">';
//                 echo '<h5 class="card-title">'.$prod->getProd_name().'</h5>';
//                 echo '</div>';
//                 echo '</div>';
//             }
//             echo '</div>';
// $P=$prod->get_products_by_id($d);
// echo $P->getRef();
// echo '<br>';
// echo $P->getProd_name();
// echo '<br>';
// echo $P->getBar_code();
// echo '<br>';
// echo $P->getOffer_price();
// echo '<br>';
// echo $P->getfinal_price();
// echo '<br>';
// echo $P->getProd_desc();
// echo '<br>';
// echo '<img src="./assets/pics_electro/'.$P->getImg().'">';
// echo '<br>';
// echo $category->get_category_by_id($P->getCategory())->getCat_name();

?>