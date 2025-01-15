<?php

class Database
{
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "258456";
    private $dbName = "youdemy";
    

    public function Getconnection()
    {
        try {
            $pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "connection failed" . $e->getMessage();
        }
    }
}
