<?php

class Database 
{
    private $conn;

    function __construct()
    {
        $this->conn= $this->connect();
    }

    private function connect()
    {



       
        try
        {
            $pdo= new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASSWORD);
            return $pdo;

        } catch(PDOException $e)
        {
            echo "désolé désolé : " . $e->getMessage();
            die;
        }
        return false;
        
    }


}