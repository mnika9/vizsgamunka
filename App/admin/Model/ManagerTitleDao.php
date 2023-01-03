<?php namespace App\admin\Model;


use App\Lib\Database;
use App\admin\Model\Icrud;

    class ManagerTitleDao implements Icrud
    {
   

            public static function all()
            {
                $dbObj = new Database();
                $conn = $dbObj->getConnection();
                $sql= "SELECT * FROM title WHERE title_deleted =0 ORDER BY `id`;";                
                $statement = $conn->prepare($sql);
                $statement->setFetchMode(\PDO::FETCH_OBJ);
                $statement->execute();
                return $statement->fetchAll();
        }
    
        public static function save(){
            $dbObj = new Database();
            $conn = $dbObj->getConnection();

            $title_name = $_POST['title_name'];
            $status = isset($_POST['status']) ? 1: 0;

            $sql = "INSERT INTO title (`title_name`, `status`) VALUES (:title_name, :status);";
            $statement = $conn->prepare($sql);
            $statement->execute([
                'title_name'=>$title_name,
                'status'=>$status,
            ]);
        }

        public static function getById(int $id)
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $statement = $conn->prepare("SELECT * FROM title WHERE `id`=:id;");
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute([
                'id' => $id,
            ]);
            return $statement->fetch();
        }
     
        public static function update(){
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $id = $_POST['id'];
            $title_name = $_POST['title_name'];
            $status = ($_POST['status']) ? 1 : 0;
            $sql= "UPDATE title SET `title_name`=:title_name, `status`= :status WHERE `id`= :id;";                
            try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'title_name' =>$title_name,
                'status'=>$status,
                'id'=>$id,

            ]);
        } catch (\PDOException $ex){
                var_dump($ex);
        }
    }
        

        public static function delete(){
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $id = $_POST['id'];
            $sql = "UPDATE title SET `deleted`=1 WHERE id=:id ;";
            try 
            {
                $statement = $conn->prepare($sql);
                $statement->execute([
                    'id'=>$id,
                ]);
            } catch (\PDOException $ex) {
               var_dump($ex);
        }
        }

    }

?>