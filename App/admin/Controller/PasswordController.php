<?php namespace App\admin\Controller;

use App\admin\Model\ManagerTitleDao;
use App\admin\Model\PasswordDao;
use Twig\Loader\FilesystemLoader;

class PasswordController 
{
    public function list()
    {
        $data = PasswordDao::all();
        $twig = (new PasswordController())->setTwigEnvironment();
        echo $twig->render('password/passwords.html.twig', ['managers'=>$data]);  
    }


  
    public function update(){
        if (isset($_POST['update'])){
            PasswordDao::update();
            header('Location: /passwords');
        }
    }

    public function editById(int $id){
        $twig = (new PasswordController())->setTwigEnvironment();
        $titleData = PasswordDao::getById($id);
        if ($titleData){
            echo $twig->render('password/passwordEdit.html.twig', ['managers'=>$titleData]); 
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function setTwigEnvironment(){
        $loader = new FilesystemLoader(__DIR__ . '\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }
}


?>