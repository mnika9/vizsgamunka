<?php namespace App\admin\Model;

use App\Lib\Database;
  
class PasswordDao
{
    public static function all(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT m.id, m.lastname, m.firstname, m.title, m.username, m.email, m.status, t.title_name FROM manager as m INNER JOIN title as t ON m.title = t.id WHERE deleted =0 ORDER BY m.id ;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function getById(int $id){
        
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT *FROM manager WHERE `id` =:id;");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute([
            'id'=>$id,
        ]);
        return $statement->fetch();
    }

    public static function update(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $id = $_POST['id'];
        $password = sha1($_POST['password']);
        $sql = "UPDATE manager SET `password`=:password WHERE `id`=:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'password'=>$password,
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }
}

