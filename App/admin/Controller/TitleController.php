<?php

namespace App\admin\Controller;


use App\admin\Model\ManagerTitleDao;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;



class TitleController implements Icrudcontroller
{


    public function list()
    {
        $data = ManagerTitleDao::all();
        $twig = (new TitleController())->setTwigEnvironment();
        echo $twig->render('title/title.html.twig', ['titles' => $data]);
    }

    public function add()
    {
        $twig = (new TitleController())->setTwigEnvironment();
        echo $twig->render('title/titleAdd.html.twig',);
    }
    

    public function save()
    {
        if (isset($_POST['save'])) {
            ManagerTitleDao::save();
            header('Location: /title');
        }
    }


    public function editById(int $id)
    {
        $twig = (new TitleController())->setTwigEnvironment();
        $titleData = ManagerTitleDao::getById($id);
        if ($titleData) {
            echo $twig->render('title/titleEdit.html.twig', ['titles' => $titleData]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }


    public function update()
    {
        if (isset($_POST['update'])) {
            ManagerTitleDao::update();
            header('Location: /title');
        }
    }

    public function deleteById(int $id)
    {
        $twig = (new TitleController())->setTwigEnvironment();
        $titleData = ManagerTitleDao::getById($id);
        if ($titleData) {
            echo $twig->render('title/titleDelete.html.twig', ['titles' => $titleData]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function delete()
    {
        if (isset($_POST['delete'])) {
            ManagerTitleDao::delete();
            header('Location: /title');
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
