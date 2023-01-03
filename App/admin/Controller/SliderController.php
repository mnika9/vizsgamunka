<?php namespace App\admin\Controller;

use App\admin\Model\SliderDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class SliderController implements ICrudController
{
    public function list()
    {
        $data = SliderDao::all();
        $twig = (new SliderController())->setTwigEnvironment();
        echo $twig->render('slider/slider.html.twig', ['sliders'=>$data]);  
    }

    public function add(){
        $twig = (new SliderController())->setTwigEnvironment();
        echo $twig->render('slider/sliderAdd.html.twig'); 
    }

    public function save()
    {
        if (isset($_POST['save'])){
            SliderDao::save();
            header('Location: /slider');
        }
    }

    public function delete(){
        if (isset($_POST['delete'])){
            SliderDao::delete();
            header('Location: /slider');
        }
    }

    public function update(){
        if (isset($_POST['update'])){
            SliderDao::update();
            header('Location: /slider');
        }
    }

    public function editById(int $id){
        $twig = (new SliderController())->setTwigEnvironment();
        $sliderData = SliderDao::getById($id);
        if ($sliderData){
            echo $twig->render('slider/sliderEdit.html.twig', ['slider'=>$sliderData]); 
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function deleteById(int $id){
        $twig = (new SliderController())->setTwigEnvironment();
        $sliderData = SliderDao::getById($id);
        if ($sliderData){
            echo $twig->render('slider/sliderDelete.html.twig', ['slider'=>$sliderData]); 
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function setTwigEnvironment(){
        $loader = new FilesystemLoader(__DIR__ . '\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true, //var_dumphoz hasonló mukodés megvalosuljon
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }
}
