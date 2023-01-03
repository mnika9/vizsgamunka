<?php namespace App\admin\Controller;


use Twig\Loader\FilesystemLoader;
use App\admin\Model\HousesDao;
use App\admin\Model\OwnerDao;


class HousesController
{

    public static function list()
    {
        $data = HousesDao::all();
        $twig = (new HousesController())->setTwigEnvironment();
        echo $twig->render('houses/houses.html.twig', ['houses' => $data]);
    }

    public static function add()
    {
        $twig = (new HousesController())->setTwigEnvironment();
        $owners = OwnerDao::all();
        echo $twig->render('houses/housesAdd.html.twig', ['owners' => $owners]);
    }

    public static function save()
   {
       if (isset($_POST['save'])) {
           HousesDao::save();
           header('Location: /houses');
       }
   }


    public static function editById(int $id)
    {
        $twig = (new HousesController())->setTwigEnvironment();
        $datas = HousesDao::getById($id);
        $owners = OwnerDao::all();
        if ($datas) {
            echo $twig->render('houses/housesEdit.html.twig', ['houses'=> $datas, 'owners' => $owners]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public static function update()
    {
        if (isset($_POST['update'])) {
            HousesDao::update();
            header('Location: /houses');
        }
    }


    // betölti ID szerint
    public static function deleteById(int $id)
    {
        $twig = (new HousesController())->setTwigEnvironment();
        $data = HousesDao::getById($id);
        if ($data) {
            echo $twig->render('houses/housesDelete.html.twig', ['houses' => $data]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public static function delete()
    {
        if (isset($_POST['delete'])) {
            HousesDao::delete();
            header('Location: /houses');
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
