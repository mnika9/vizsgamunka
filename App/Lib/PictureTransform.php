<?php namespace App\Lib;

    class PictureTransform {
        public static function fileNameConvert($szoveg){
            $search = array('Á', 'É', 'Ú', 'Ő', 'Ű', 'Ó', 'Ü', 'Ö', 'Í', 'á', 'é', 'ú', 'ő', 'ű', 'ó', 'ü', 'ö', 'í');
            $replace = array('a', 'e', 'u', 'o', 'u', 'o', 'u', 'o', 'i', 'a', 'e', 'u', 'o', 'u', 'o', 'u', 'o', 'i');
            $szoveg = str_replace($search, $replace, $szoveg);
        return $szoveg;
        }

        public static function imgResizeAndSave($dst_folder,$new_lg_Xsize, $new_lg_Ysize, $new_sm_Xsize, $new_sm_Ysize)
        {
            $target_dir_large = $_SERVER['DOCUMENT_ROOT'] ."/public/images/$dst_folder/large/";
        
            $target_dir_small = $_SERVER['DOCUMENT_ROOT'] ."/public/images/$dst_folder/small/";
        
            //basename() fv -->teljes elérési utvonal nevét adja meg
            $target_file_large = $target_dir_large . basename($_FILES["pictureLink"]["name"]);
            $target_file_small = $target_dir_small . basename($_FILES["pictureLink"]["name"]);
        
            $target_file_name=$_FILES["pictureLink"]["name"];
        
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file_large,PATHINFO_EXTENSION));
            // Ellenőrzi, hogy kép -e a fájl, hogy nem -e fake kép, tehát van mérete
            if(isset($_POST["save"]) || isset($_POST["update"])) {
                $check = getimagesize($_FILES["pictureLink"]["tmp_name"]);
                if($check !== false) {
                // echo " A fájl kép - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo " A fájl nem kép.";
                    $uploadOk = 0;
                }
            }
            // Létezik -e a fájl
            if (file_exists($target_file_large)) {
                echo " Sajnálom a fájl már létezik.";
                $uploadOk = 0;
            }
            // Fájméret csak 3MB alatt lehet 3.000.000 byte=3MB
            if ($_FILES["pictureLink"]["size"] > 3000000) {
                echo " Sajnálom, túl nagy a fájlméret!";
                $uploadOk = 0;
            }
            // Csak bizonyos tipusokat engedélyezunk
            if($imageFileType != "jpg") {
                echo " Csak JPG formátum engedélyezettek!";
                $uploadOk = 0;
            }
            // leellenőrizzuk hogy $uploadOk 0 vagy van valamilyen hiba
            if ($uploadOk == 0) {
                echo " Sajnos a fájlfeltoltés nem sikerult!";
                die();
            // ha minden ok megprobáljuk feltolteni a fájlt
            } else {
        
                //large
                list($width, $height) = getimagesize($_FILES["pictureLink"]["tmp_name"]);
                $src = imagecreatefromjpeg($_FILES["pictureLink"]["tmp_name"]);
                $large = imagecreatetruecolor($new_lg_Xsize, $new_lg_Ysize);
                imagecopyresampled($large, $src, 0, 0, 0, 0, $new_lg_Xsize, $new_lg_Ysize, $width, $height);
        
                if ($large) {
                    imagejpeg($large, self::fileNameConvert($target_file_large));
                    //echo " A fájl ". basename($_FILES["pictureLink"]["name"]). " feltoltésre kerult.";
                } else {
                    echo " Sajnos hiba volt a feltöltés során.";
                    die();
                }
                
                //small
                $small = imagecreatetruecolor($new_sm_Xsize, $new_sm_Ysize);
                imagecopyresampled($small, $src, 0, 0, 0, 0, $new_sm_Xsize, $new_sm_Ysize, $width, $height);
        
                if ($small) {
                    imagejpeg($small, self::fileNameConvert($target_file_small));
                    //echo " A fájl ". basename($_FILES["pictureLink"]["name"]). " feltoltésre kerult.";
                } else {
                    echo " Sajnos hiba volt a feltöltés során.";
                    die();
                }
            }
            return $target_file_name;
        }
    }
?>