<?php

namespace App\admin\Controller;


use App\admin\Model\OwnerDao;
use Twig\Loader\FilesystemLoader;




class OwnerController implements Icrudcontroller
{


    public function list()
    {
        $ownerData = OwnerDao::all();
        $twig = (new OwnerController())->setTwigEnvironment();
        echo $twig->render('owner/owner.html.twig', ['owners' => $ownerData]);
    }

    public function add()
    {
        $twig = (new HousesController())->setTwigEnvironment();
        $ownerHouses = OwnerDao::all();
        echo $twig->render('owner/ownerAdd.html.twig', ['ownerHouses' => $ownerHouses]);
    }
    

    public function save()
    {
        if (isset($_POST['save'])) {
            OwnerDao::save();
            header('Location: /owner');
        }
    }


    public function editById(int $id)
    {
        $twig = (new OwnerController())->setTwigEnvironment();
        $ownerData = OwnerDao::getById($id);
        if ($ownerData) {
            echo $twig->render('owner/ownerEdit.html.twig', ['owners' => $ownerData]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }


    public function update()
    {
        if (isset($_POST['update'])) {
            OwnerDao::update();
            header('Location: /owner');
        }
    }

    public function deleteById(int $id)
    {
        $twig = (new OwnerController())->setTwigEnvironment();
        $ownerData = OwnerDao::getById($id);
        if ($ownerData) {
            echo $twig->render('owner/ownerDelete.html.twig', ['owners' => $ownerData]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function delete()
    {
        if (isset($_POST['delete'])) {
            OwnerDao::delete();
            header('Location: /owner');
        }
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
