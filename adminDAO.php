<?php
class Admin{
    private $id;
    private $username;
    private $email;
    private $passw;

    public function __construct($id,$username,$email,$passw){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passw = $passw;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassw(){
        return $this->passw;
    }
}

class adminDAO{
    private $db;
    public function __construct(){
        $this-> db = Database::getInstance()->getConnection();
    }

    public function get_admin(){
        $query="SELECT * FROM admins";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $adminsData = $stmt -> fetchAll();
        $admins = array();
        foreach($adminsData as $A){
            $admins[] = new Admin($A["id"], $A["username"], $A["email"], $A["passw"],);

        }
        return $admins;
    }
}

?>