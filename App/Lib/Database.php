<?php namespace App\Lib;

use App\Config;

class Database{

    public function getConnection()
    {
    try {
        $dsn = "mysql:host=127.0.0.1;dbname=family;charset=utf8;port:3306";
        $user ="root";
        $password = "";
        $conn = new \PDO($dsn, $user, $password);
    }   catch (\PDOException $ex) {
       // echo "Connection failed: " . $ex->getMessage();
        var_dump($ex);
    }
      return $conn;
}
      
    }
?>