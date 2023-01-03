<?php namespace App\admin\Controller;


use App\admin\Model\ManagerDao;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\admin\Model\ManagerTitleDao;


class ManagerController
{

    public static function list()
    {
        $data = ManagerDao::all();
        $twig = (new ManagerController())->setTwigEnvironment();
        echo $twig->render('manager/manager.html.twig', ['managers' => $data]);
    }

    public static function add()
    {
        $twig = (new ManagerController())->setTwigEnvironment();
        $managerTitles = ManagerTitleDao::all();
        echo $twig->render('manager/managerAdd.html.twig', ['managerTitles' => $managerTitles]);
    }

    public static function save()
    {
        if (isset($_POST['save'])) {
            ManagerDao::save();
            header('Location: /manager');
        }
    }



    public static function editById(int $id)
    {
        $twig = (new ManagerController())->setTwigEnvironment();
        $managerdata = ManagerDao::getById($id);
        $managerTitles = ManagerTitleDao::all();
        if ($managerdata) {
            echo $twig->render('manager/managerEdit.html.twig', ['managers' => $managerdata, 'managerTitles' => $managerTitles]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }


    public static function update()
    {
        if (isset($_POST['update'])) {
            ManagerDao::update();
            header('Location: /manager');
        }
    }



    // betölti ID szerint
    public static function deleteById(int $id)
    {
        $twig = (new ManagerController())->setTwigEnvironment();
        $managerdata = ManagerDao::getById($id);
        if ($managerdata) {
            echo $twig->render('manager/managerDelete.html.twig', ['managers' => $managerdata]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public static function delete()
    {
        if (isset($_POST['delete'])) {
            ManagerDao::delete();
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
