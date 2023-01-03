<?php namespace App\publicPage\Controller;


use App\Lib\Database;
use Twig\Loader\FilesystemLoader;
use App\publicPage\Model\ContactDao;

class ContactController{

    public function list()
    {
        $contactData = ContactDao::all();
        $twig = (new ContactController())->setTwigEnvironment();
        echo $twig->render('/contact.html.twig', ['contacts' => $contactData]);
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