<?php namespace App\publicPage\Controller;


use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class HomeController {

public function indexAction()

{

    $twig = (new HomeController())->setTwigEnvironment();
    echo $twig->render('home.html.twig'); 
   
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
