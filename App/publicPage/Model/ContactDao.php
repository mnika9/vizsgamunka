<?php namespace App\publicPage\Model;


use Twig\Loader\FilesystemLoader;
use App\publicPage\Controller\Controller\ContactController;
use App\Lib\Database;


class ContactDao{

    public static function all()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql= "SELECT * FROM contact ;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }
}
?>