<?php
class Client{
    private $id;
    private $full_name;
    private $adresse;
    private $city;
    private $phonenumber;
    private $username;
    private $e_mail;
    private $psw;
    private $activ_account;
    public function __construct($id, $full_name, $adresse, $city, $phonenumber, $username, $e_mail, $psw, $activ_account) {
        $this->id = $id; 
        $this->full_name = $full_name;
        $this->adresse = $adresse;
        $this->city = $city;
        $this->phonenumber = $phonenumber;
        $this->username = $username;
        $this->e_mail = $e_mail;
        $this->psw = $psw;
        $this->activ_account = $activ_account;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
    

    /**
     * Get the value of full_name
     */ 
    public function getFull_name()
    {
        return $this->full_name;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of e_mail
     */ 
    public function getE_mail()
    {
        return $this->e_mail;
    }

    /**
     * Get the value of psw
     */ 
    public function getPsw()
    {
        return $this->psw;
    }

    /**
     * Get the value of activ_account
     */ 
    public function getActiv_account()
    {
        return $this->activ_account;
    }

    /**
     * Get the value of phonenumber
     */ 
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }
}

?>