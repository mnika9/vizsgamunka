<?php namespace App\admin\Controller;

use App\admin\Model\Icrud;
use App\Lib\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\admin\Model\LoginDao;


class AdminController {

   public function indexStart(){
      
      $twig = (new AdminController())->setTwigEnvironment();
      echo $twig->render('/admin.html.twig');
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