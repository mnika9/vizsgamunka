<?php namespace App\admin\Model;

use App\Lib\Database;
use App\admin\Model\Icrud;

    class HousesDao  implements Icrud{ 

        public static function all()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql= "SELECT h.id, h.name, h.postcode, h.city, h.street, h.street_type, h.house_number, h.space, h.owner_id, h.sale, o.lastname, o.firstname FROM houses as h LEFT JOIN owners as o ON h.owner_id=o.id WHERE h.deleted =0 ORDER BY h.id ;";
            $statement = $conn->prepare($sql);
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute();
            return $statement->fetchAll();
        }

    public static function getById(int $id)
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $statement = $conn->prepare("SELECT * FROM houses WHERE id =:id;");
            $statement->setFetchMode(\PDO::FETCH_OBJ);
            $statement->execute([
                'id' => $id,
            ]);
            return $statement->fetch();
        }
    

        public static function add()
        {
           $name = $_POST['name'];
           $postcode = $_POST['postcode'];
           $city = $_POST['city'];
           $street = $_POST['street'];
           $street_type = $_POST['street_type'];
           $house_number = $_POST['house_number'];
           $space = $_POST['space'];
           $sale = isset($_POST['sale']) ? 1 : 0;
           
           $dbObj = new Database();
           $conn = $dbObj->getConnection();
           $sql = "INSERT INTO houses (`name`,`postcode`,`city`, `street`, `street_type`, `house_number`, `space`, `sale`) VALUES (:name, :postcode, :city, :street, :street_type, :house_number, :space, :sale);";
           $statement = $conn->prepare($sql);
           $statement->setFetchMode(\PDO::FETCH_OBJ);
           $statement->execute([
              'name'=>$name,
              'postcode'=>$postcode,
              'city'=>$city,
              'street'=>$street,
              'street_type'=>$street_type,
              'house_number'=>$house_number,
              'space'=>$space,
              'sale'=>$sale,
           ]);  
       }
            
        public static function save()
        {
            $name = $_POST['name'];
            $postcode = $_POST['postcode'];
            $city = $_POST['city'];
            $street = $_POST['street'];
            $street_type = $_POST['street_type'];
            $house_number = $_POST['house_number'];
            $space = $_POST['space'];
           
            $sale = isset($_POST['sale']) ? 1 : 0;

            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            $sql = "INSERT INTO houses (`name`,`postcode`, `city`, `street`, `street_type`, `house_number`, `space`, `sale`) VALUES (:name, :postcode, :city, :street, :street_type, :house_number, :space, :sale);";
            $statement = $conn->prepare($sql);

            $statement->execute([
                'name'=>$name,
                'postcode'=>$postcode,
                'city'=>$city,
                'street'=>$street,
                'street_type'=>$street_type,
                'house_number'=>$house_number,
                'space'=>$space,
                'sale'=>$sale,
            ]);
        }

        public static function update()
        {
            $dbObj = new Database();
            $conn = $dbObj->getConnection();

            $id = $_POST['id'];
            $name = $_POST['name'];
            $postcode = $_POST['postcode'];
            $city = $_POST['city'];
            $street = $_POST['street'];
            $street_type = $_POST['street_type'];
            $house_number = $_POST['house_number'];
            $space = $_POST['space'];
            $sale = isset($_POST['sale']) ? 1 : 0;
            $sql ="UPDATE houses SET `name`=:name, `postcode`=:postcode, `city`=:city, `street`=:street, `street_type`=:street_type, `house_number`=:house_number, `space`=:space, `sale`= :sale WHERE id=:id;";
            
            try{
            $statement = $conn->prepare($sql);
            $statement->execute([
                'name'=>$name,
                'postcode'=>$postcode,
                'city'=>$city,
                'street'=>$street,
                'street_type'=>$street_type,
                'house_number'=>$house_number,
                'space'=>$space,
                'sale'=>$sale,
               
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
            $sql= "SELECT * FROM houses;";                
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
            $sql = "UPDATE houses SET `deleted`=1 WHERE id=:id ;";
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
