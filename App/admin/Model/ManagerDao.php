<?php namespace App\admin\Model;

use App\Lib\Database;
use App\admin\Model\Icrud;

    class ManagerDao implements Icrud {

        public static function all()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql= "SELECT m.id, m.lastname, m.firstname, m.title, m.username, m.password, m.email, m.phone_number, m.status, t.title_name FROM manager as m INNER JOIN title as t ON m.title = t.id WHERE deleted =0 ORDER BY m.id ;";
            $statement = $conn->prepare($sql);
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute();
            return $statement->fetchAll();
        }

        public static function getById(int $id)
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $statement = $conn->prepare("SELECT * FROM manager WHERE `id` =:id;");
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute([
                'id' => $id,
            ]);
            return $statement->fetch();
        }
    
         public static function add()
         {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $title = $_POST['title'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $status = isset($_POST['status']) ? 1 : 0;
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql = "INSERT INTO manager (`m.lastname`, `m.firstname`, `m.title`, `m.password`,`m.username`, `m.email`, `m.phone_number`, `m.status`) VALUES (:lastname, :firstname, :title, :username, :password, :email, :phone_number, :status);";
            $statement = $conn->prepare($sql);
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute([
               'lastname'=>$lastname,
               'firstname'=>$firstname,
               'title'=>$title,
               'username'=>$username,
               'password'=>$password,
               'email'=>$email,
               'phone_number'=>$phone_number,
               'status'=>$status,
            ]);  
        }

        public static function save()
        {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $managerTitle = $_POST['managerTitle'];
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $status = isset($_POST['status']) ? 1 : 0;

            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql = "INSERT INTO manager (`lastname`, `firstname`, `title`,`username`, `password`, `email`, `phone_number`, `status`) VALUES (:lastname, :firstname, :managerT, :username, :password, :email, :phone_number, :status);";
            $statement = $conn->prepare($sql);

            $statement->execute([
               'lastname'=>$lastname,
               'firstname'=>$firstname,
               'managerT'=>$managerTitle,
               'username'=>$username,
               'password'=>$password,
               'email'=>$email,
               'phone_number'=>$phone_number,
               'status'=>$status,
            ]);
        }
        
        public static function deleteById(int $id)
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql= "SELECT * FROM manager;";                
            $statement = $conn->prepare($sql);
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute();
            return $statement->fetchAll();
        }


        public static function update()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();

            $id = $_POST['id'];
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $managerTitle = $_POST['managerTitle'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $status = isset($_POST['status']) ? 1 : 0;
            $sql ="UPDATE manager SET `lastname`=:lastname, `firstname`=:firstname, `title`=:managerTitle, `username`=:username, `email`=:email, `phone_number`=:phone_number, `status`= :status WHERE id=:id;";
            
            try{
            $statement = $conn->prepare($sql);
            $statement->execute([
               'lastname'=>$lastname,
               'firstname'=>$firstname,
               'managerTitle'=>$managerTitle,
               'username'=>$username,
               'email'=>$email,
               'phone_number'=>$phone_number,
               'status'=>$status,
               'id'=>$id,
            ]);
        } catch (\PDOException $ex){
            var_dump($ex);
        }
        }


        public static function delete()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $id = $_POST['id'];
            $sql = "UPDATE manager SET `deleted`=1 WHERE `id`=:id ;";
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
