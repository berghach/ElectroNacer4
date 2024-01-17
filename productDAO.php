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
    public function get_products_by_filter($filter){
        $stmt = $this->db->query($filter);
        $stmt->execute();
        $filteredData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $Products = array();
        foreach($filteredData as $P){
            $Products[] = new Product($P["ref"], $P["prod_name"], $P["bar_code"], $P["img"], $P["sell_price"], $P["final_price"], $P["offer_price"], $P["prod_desc"], $P["min_quant"], $P["stock_quant"], $P["bl"], $P["category_fk"]);
            
        }
        return $Products;
    }
    public function insert_product(Product $product){
        $stmt= $this->db->prepare("INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk) 
                                    VALUES (:_name, :barCode, :img, :Sprice, :Fprice, :Oprice, :descrip, :minQuant, :stockQuant, :category)");
        $name = $product->getProd_name();
        $barcode = $product->getBar_code();
        $img = $product->getImg();
        $Sprice = $product->getsell_price();
        $Fprice = $product->getfinal_price();
        $Oprice = $product->getOffer_price();
        $desc = $product->getProd_desc();
        $minQuant = $product->getMin_quant();
        $stockQ = $product->getStock_quant();
        $category = $product->getCategory();
        $stmt->bindParam(":_name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":barCode", $barcode, PDO::PARAM_INT);
        $stmt->bindParam(":img", $img, PDO::PARAM_STR);
        $stmt->bindParam(":Sprice", $Sprice, PDO::PARAM_STR);
        $stmt->bindParam(":Fprice", $Fprice, PDO::PARAM_STR);
        $stmt->bindParam(":Oprice", $Oprice, PDO::PARAM_STR);
        $stmt->bindParam(":descrip", $desc, PDO::PARAM_STR);
        $stmt->bindParam(":minQuant", $minQuant, PDO::PARAM_INT);
        $stmt->bindParam(":stockQuant", $stockQ, PDO::PARAM_INT);
        $stmt->bindParam(":category", $category, PDO::PARAM_INT);
        if($stmt -> execute()){
            return true;
        }else{
            return false;
        }

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
        $stmt= $this->db->prepare("UPDATE product SET bl=0 WHERE ref= :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> execute();
        if( $stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
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