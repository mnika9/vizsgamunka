<?php namespace App\admin\Model;

use App\Lib\Database;
use App\Lib\PictureTransform;
use App\admin\Model\ICrudDao;
  
class SliderDao implements ICrud
{
    public static function all(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT * FROM slider WHERE `deleted` =0 ORDER BY `id`;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save()
    {
        $name = $_POST['name'];

        if (!empty($_FILES['pictureLink']['name'])){
            $picture_link = PictureTransform::imgResizeAndSave('sliders',1900,1080,800,600);
        }    
        $code = $_POST['code'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $status = isset($_POST['status']) ? 1 : 0;

        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "INSERT INTO slider (`name`,`picture_link`,`code`,`description`,`title`,`status`) VALUES (:name, :picture_link, :code, :description, :title, :status);";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'name'=>$name,
            'picture_link'=>$picture_link,
            'code'=>$code,
            'description'=>$description,
            'title'=>$title,
            'status'=>$status
        ]);
    }

    public static function getById(int $id){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT * FROM slider WHERE id =:id;");
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
        $picture_link = $_POST['picture_link'];
        $code = $_POST['code'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $status = isset($_POST['status']) ? 1 : 0;

        $sql = "UPDATE slider SET `name`=:name, `picture_link`=:picture_link, `code`=:code, `description`=:description,`title`=:title,`status`=:status WHERE `id`=:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'name'=>$name,
                'picture_link'=>$picture_link,
                'code'=>$code,
                'description'=>$description,
                'title'=>$title,
                'status'=>$status,
                'id'=>$id
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
  
        $sql = "UPDATE slider SET `deleted` =1 WHERE `id`=:id;";
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

