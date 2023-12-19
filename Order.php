<?php

class Order{
    private $id;
    private $creation_date;
    private $shipping_date;
    private $delivery_date;
    private $total_price;
    private $bl;
    private $client_id;

    
    public function __construct($id, $creation_date, $shipping_date, $delivery_date, $total_price, $bl, $client_id){
        $this->id = $id;
        $this->creation_date = $creation_date;
        $this->shipping_date = $shipping_date;
        $this->delivery_date = $delivery_date;
        $this->total_price = $total_price;
        $this->bl = $bl;
        $this->client_id = $client_id;
    }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of creation_date
     */ 
    public function getCreation_date()
    {
        return $this->creation_date;
    }

    /**
     * Get the value of shipping_date
     */ 
    public function getShipping_date()
    {
        return $this->shipping_date;
    }

    /**
     * Get the value of delivery_date
     */ 
    public function getDelivery_date()
    {
        return $this->delivery_date;
    }

    /**
     * Get the value of total_price
     */ 
    public function getTotal_price()
    {
        return $this->total_price;
    }

    /**
     * Get the value of bl
     */ 
    public function getBl()
    {
        return $this->bl;
    }

    /**
     * Get the value of client_id
     */ 
    public function getClient_id()
    {
        return $this->client_id;
    }

    
}

?>