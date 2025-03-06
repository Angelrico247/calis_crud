<?php

require_once "databaseClass.php";

class UserForm
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function login(string $username, string $password):bool
    {
        $query = "SELECT password FROM usuarios WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch((PDO::FETCH_ASSOC));

        if ($user && password_verify($password, $user["password"])); {
            session_start();
            $_SESSION["username"] = $username;
            return true;
        }
        return false;
    }

    public function register(string $username, string $password):bool
    {

        $query = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        return $stmt->execute();
    }
}
