<?php

require_once("connection.php");
require_once("Client.php");

class clientDAO {
    private $db;
    public function __construct(){
        $this-> db = Database::getInstance()->getConnection();
    }

    public function get_client(){
        $query="SELECT * FROM client";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ClientsData = $stmt -> fetchAll();
        $Clients = array();
        foreach($ClientsData as $C){
            $Clients[] = new Client($C["id"], $C["full_name"], $C["adresse"], $C["city"], $C["phonenumber"], $C["username"], $C["e_mail"], $C["psw"],$C["activ_account"]);
            
        }
        return $Clients;
    }

    public function get_client_by_id($id){
        $query= "SELECT * FROM client WHERE id=$id";
        $stmt= $this->db->query($query);
        $stmt -> execute();
        $ClientData = $stmt -> fetchAll();
        foreach($ClientData as $C){
            $Client = new Client($C["id"], $C["full_name"], $C["adresse"], $C["city"], $C["phonenumber"], $C["username"], $C["e_mail"], $C["psw"],$C["activ_account"]);
            
        }
        return $Client;
    }


    public function insert_client($client) {
        $query = "INSERT INTO client (full_name, adresse, city, phonenumber, username, e_mail, psw) 
                  VALUES (:full_name, :adresse, :city, :phonenumber, :username, :e_mail, :psw)";
    
        $stmt = $this->db->prepare($query);
        $A = $client->getFull_name();
        $B = $client->getAdresse();
        $C = $client->getCity();
        $D = $client->getPhonenumber();
        $E = $client->getUsername();
        $F = $client->getE_mail();
        $G = $client->getPsw();
        // Bind parameters
        $stmt->bindParam(':full_name', $A, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $B, PDO::PARAM_STR);
        $stmt->bindParam(':city', $C, PDO::PARAM_STR);
        $stmt->bindParam(':phonenumber', $D, PDO::PARAM_STR);
        $stmt->bindParam(':username', $E, PDO::PARAM_STR);
        $stmt->bindParam(':e_mail', $F, PDO::PARAM_STR);
        $stmt->bindParam(':psw', $G, PDO::PARAM_STR);
    
        try {
            $stmt->execute();
            echo '<div style="color: green; font-weight: bold; text-align: center;">User registered successfully.</div>';
            header("Location: login.php");
        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage();
        }
    }
    
    public function verify_client($id){
        $query= "UPDATE client SET activ_account = 1 WHERE id=$id ";
                echo $query;
                $stmt= $this->db->query($query);
                $stmt -> execute();

    }

    public function unverify_client($id){
        $query= "UPDATE client SET activ_account = 0 WHERE id=$id ";
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    
    public function delete_client($id){
        $query= "DELETE FROM client WHERE id=$id ";
        $stmt= $this->db->query($query);
        $stmt -> execute();
    }

}

?>