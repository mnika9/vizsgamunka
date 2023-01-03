<?php namespace App\publicPage\Controller;


use Twig\Loader\FilesystemLoader;

class PageController{

    public function list()
    {
        
        $twig = (new PageController())->setTwigEnvironment();
        echo $twig->render('/bekesszentandras/bekesszentandras.html.twig'); 
    }

    public function listSzarvas()
    {
        
        $twig = (new PageController())->setTwigEnvironment();
        echo $twig->render('/szarvas/szarvas.html.twig'); 
    }

    public function listaction()
    {
        
        $twig = (new PageController())->setTwigEnvironment();
        echo $twig->render('/akcios_napok/akciosnapok.html.twig'); 
    }



    public function setTwigEnvironment()
    {

        $loader = new FilesystemLoader(__DIR__ . '\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }
}