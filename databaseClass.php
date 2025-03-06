<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $pd = "";
    private $db = "bienes_raices";

    public function connect(){

        
        try {
            $connection = new PDO("mysql:host=" . $this->host .";dbname=" . $this->db, $this->username, $this->pd);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            die("error " .$e->getMessage());
        }
        
    }

}

?>