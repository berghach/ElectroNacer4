<?php
class Product{
    private $ref;
    private $prod_name;
    private $bar_code;
    private $img;
    private $sell_price;
    private $final_price;
    private $offer_price;
    private $prod_desc;
    private $min_quant;
    private $stock_quant;
    private $bl;
    private $category;

    public function __construct($ref, $prod_name, $bar_code, $img, $sell_price, $final_price, $offer_price, $prod_desc, $min_quant, $stock_quant, $bl, $category) {
        $this->ref = $ref; 
        $this->prod_name = $prod_name; 
        $this->bar_code = $bar_code; 
        $this->img = $img; 
        $this->sell_price = $sell_price; 
        $this->final_price = $final_price;
        $this->offer_price = $offer_price; 
        $this->prod_desc = $prod_desc; 
        $this->min_quant = $min_quant; 
        $this->stock_quant = $stock_quant; 
        $this->bl = $bl;
        $this->category = $category;
    }


    public function getRef()
    {
        return $this->ref;
    }

    public function getProd_name()
    {
        return $this->prod_name;
    }

    public function getBar_code(){
        return $this->bar_code;
    }

    public function getImg(){
        return $this->img;
    }

    public function getsell_price(){
        return $this->sell_price;
    }

    public function getfinal_price(){
        return $this->final_price;
    }
    public function getOffer_price(){
        return $this->offer_price;
    }

    public function getProd_desc(){
        return $this->prod_desc;
    }

    public function getMin_quant(){
        return $this->min_quant;
    }

    public function getStock_quant(){
        return $this->stock_quant;
    }
    public function getbl(){
        return $this->bl;
    }

    public function getCategory(){
        return $this->category;
    }

}

?>