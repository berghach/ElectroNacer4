<?php

require_once("connection.php");
require_once("Category.php");

class categoryDAO {
    private $db;
    public function __construct(){
        $this-> db = Database::getInstance()->getConnection();
    }

    public function get_categories(){
        $query="SELECT * FROM category";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $CategoriesData = $stmt -> fetchAll();
        $Categories = array();
        foreach($CategoriesData as $C){
            $Categories[] = new Category($C["id"], $C["cat_name"], $C["cat_descr"], $C["img"]);
            
        }
        return $Categories;
    }

    public function insert_category($category){
        $query= "INSERT INTO category(cat_name, cat_descr, img)
                VALUES ('".$category->getCat_name()."','".$category->getCat_descr()."','".$category->getImg()."')";
                echo $query;
                $stmt= $this->db->query($query);
                $stmt -> execute();

    }

    public function update_category($category){
        $query= "UPDATE product SET cat_name= '".$category->getCat_name()."', cat_descr= ".$category->getCat_descr().",
                 img= '".$category->getImg()."' WHERE id= ".$category->getId()." ";
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    
    public function delete_category($id){
        $query= "UPDATE category SET bl=0 WHERE id= $id";
        $stmt= $this->db->query($query);
        $stmt -> execute();
    }

    public function get_category($id){
        $query= "SELECT * FROM category WHERE id=$id";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $CategoriesData = $stmt -> fetchAll();
        foreach($CategoriesData as $C){
            $Cat = new Category($C["id"], $C["cat_name"], $C["cat_descr"], $C["img"]);
            
        }
        return $Cat;
    }

    
}

// $D = 5;
// $category = new categoryDAO();
// $cat = $category ->get_category($D);
// echo $cat->getCat_name();
// echo $cat->getCat_descr();

?>