<?php
class Category{
    private $id;
    private $cat_name;
    private $cat_descr;
    private $img;
    
    public function __construct($id, $cat_name, $cat_descr, $img, ) {
        $this->id = $id; 
        $this->cat_name = $cat_name; 
        $this->cat_descr = $cat_descr; 
        $this->img = $img; 
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
    

    /**
     * Get the value of cat_name
     */ 
    public function getCat_name()
    {
        return $this->cat_name;
    }

    /**
     * Get the value of cat_descr
     */ 
    public function getCat_descr()
    {
        return $this->cat_descr;
    }

    /**
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }
}

?>