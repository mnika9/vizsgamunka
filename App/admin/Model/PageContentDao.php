<?php namespace App\admin\Model;

use App\Lib\Database;
use App\admin\Model\ICrudDao;
  
class PageContentDao implements ICrud
{
    public static function all(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT * FROM page_content WHERE deleted= 0 ORDER BY id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save()
    {
        $name = $_POST['name'];
        $code = $_POST['code'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "INSERT INTO page_content (`name`,`code`,`description`,`title`,`content`,`status`, `created_at`) VALUES (:name, :code, :description, :title, :content,:status, ;";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'name'=>$name,
            'code'=>$code,
            'description'=>$description,
            'title'=>$title,
            'content'=>$content,
            'status'=>$status
        ]);
    }

    public static function getById(int $id){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT * FROM page_content WHERE id =:id;");
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
        $name = $_POST['name'];
        $code = $_POST['code'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        $sql = "UPDATE page_content SET `name`=:name, `code`=:code, `description`=:description, `title`=:title,`content`=:content, `status`=:status, WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'name'=>$name,
                'code'=>$code,
                'description'=>$description,
                'title'=>$title,
                'content'=>$content,
                'status'=>$status,
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }

    public static function delete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];
  
        $sql = "UPDATE page_content SET `deleted`=1  WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }
}

