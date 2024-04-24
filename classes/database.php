<?php

class Database 
{
    private $conn;

    function __construct()
    {
        $this->conn= $this->connect();
    }
    //connexion db
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

    public function write($query, $data_array=[]) 
    {
         $conn = $this->connect();
         $statement = $conn->prepare($query);

       
         $check = $statement->execute($data_array);
         if($check)
         {
             return true;
         }

         return false;
    }
     public function read($query, $data_array=[]) 
    {
         $conn = $this->connect();
         $statement = $conn->prepare($query);

        
         $check = $statement->execute($data_array);

         if($check)
         {
            $result=$statement->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result) > 0)
            {
                return $result;
            }
             return false;
         }

         return false;
    }
    public function generate_id($max)
        {
            $rand_count = rand(4, $max);
            $rand = "";
            for ($i = 0; $i < $rand_count; $i++) {
             $r = rand(0, 9);
            $rand .= $r;
        }
            return $rand;
        }

}
?>