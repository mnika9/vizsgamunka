<?php namespace App\admin\Controller;

use App\admin\Model\Icrud;
use App\Lib\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\admin\Model\LoginDao;



class LoginController {

    public function login()
    {
        $twig = (new LoginController())->setTwigEnvironment();
        echo $twig->render('manager/login.html.twig');
    }

      
        public function adminLoginValidate(){
            if (empty($_POST['username'])) {
                    echo 'A felhasználónév hiányzik';
                }
    
           elseif (empty($_POST['password'])) {
            echo 'A jelszó hiányzik';
        }
         
            else {
                LoginDao::loginValidate();
                header('Location: /manager');
                }
            }
    
   public static function setTwigEnvironment()
   {

       $loader = new FilesystemLoader(__DIR__ . '\..\View');
       $twig = new \Twig\Environment($loader, [
           'debug' => true,
       ]);
       $twig->addExtension(new \Twig\Extension\DebugExtension());
       return $twig;
   }
}

?>
