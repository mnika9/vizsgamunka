<?php namespace App\admin\Model;

use App\Lib\Database;


class LoginDao{
    public static function loginValidate()
    {
     
     $hashedPassword = hash('sha1', $_POST['password']);
     $username = $_POST['username'];
       $dbObj = new Database();
       $conn = $dbObj->getConnection();
       $statement = $conn->prepare("SELECT * FROM manager WHERE `username` =:username;");
       $statement->execute([
           'username'=>$username,
       ]);
       $storedPassword = $statement->fetchColumn();
       if ($hashedPassword == $storedPassword) {
         // password is correct
       } else {
         // password is incorrect
       }
      }
}

?>