<?php namespace App\admin\Model;


use App\Lib\Config;
use App\Lib\Database;
use App\admin\Model\Icrud;

    class OwnerDao implements Icrud {

        public static function all()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql= "SELECT o.id, o.lastname, o.firstname, o.email, o.phone_number, o.houses, o.status FROM owners as o WHERE deleted =0 ORDER BY o.id ;";
            $statement = $conn->prepare($sql);
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute();
            return $statement->fetchAll();
        }

        public static function getById(int $id)
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $statement = $conn->prepare("SELECT * FROM owners WHERE id =:id;");
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
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $houses = $_POST['houses'];
            $status = isset($_POST['status']) ? 1 : 0;

            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql = "INSERT INTO owners (`lastname`, `firstname`, `email`, `phone_number`, `houses`, `status`) VALUES (:lastname, :firstname, :email, :phone_number, :houses, :status) LEFT JOIN houses;";
            $statement = $conn->prepare($sql);
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute([
               'lastname'=>$lastname,
               'firstname'=>$firstname,
               'email'=>$email,
               'phone_number'=>$phone_number,
               'houses'=>$houses,
               'status'=>$status,
            ]);  
        }


        public static function save()
        {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $ownerHouses = $_POST['ownerHouses'];           
            $status = isset($_POST['status']) ? 1 : 0;

            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql = "INSERT INTO owners (`lastname`, `firstname`, `email`, `phone_number`, `houses`, `status`) VALUES (:lastname, :firstname, :email, :phone_number, :ownerHouses, :status);";
            $statement = $conn->prepare($sql);

            $statement->execute([
               'lastname'=>$lastname,
               'firstname'=>$firstname,
               'email'=>$email,
               'phone_number'=>$phone_number,
               'ownerHouses'=>$ownerHouses,
               'status'=>$status,
            ]);
        }


        public static function update()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();

            $id = $_POST['id'];
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $status = isset($_POST['status']) ? 1 : 0;
            $sql ="UPDATE owners SET `lastname`=:lastname, `firstname`=:firstname, `email`=:email, `phone_number`=:phone_number,  `status`= :status WHERE id=:id;";
            
            try{
            $statement = $conn->prepare($sql);
            $statement->execute([
               'lastname'=>$lastname,
               'firstname'=>$firstname,
               'email'=>$email,
               'phone_number'=>$phone_number,
               'status'=>$status,
               'id'=>$id,
            ]);
        } catch (\PDOException $ex){
            var_dump($ex);
        }
        }

        public static function deleteById(int $id)
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql= "SELECT * FROM owners;";                
            $statement = $conn->prepare($sql);
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute();
            return $statement->fetchAll();
        }


        public static function delete()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $id = $_POST['id'];
            $sql = "UPDATE owners SET `deleted`=1 WHERE id=:id ;";
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
