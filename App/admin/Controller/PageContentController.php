<?php namespace App\admin\Controller;

use App\admin\Model\PageContentDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PageContentController implements ICrudController
{
    public function list()
    {
        $data = PageContentDao::all();
        $twig = (new PageContentController())->setTwigEnvironment();
        echo $twig->render('page_content/page_contents.html.twig', ['pageContents'=>$data]);  
    }

    public function add(){
        $twig = (new PageContentController())->setTwigEnvironment();
        echo $twig->render('page_content/new_page_content.html.twig'); 
    }

    public function save()
    {
        if (isset($_POST['save'])){
            PageContentDao::save();
            header('Location: /pageContents');
        }
    }

    public function delete(){
        if (isset($_POST['delete'])){
            PageContentDao::delete();
            header('Location: /pageContents');
        }
    }

    public function update(){
        if (isset($_POST['update'])){
            PageContentDao::update();
            header('Location: /pageContents');
        }
    }

    public function editById(int $id){
        $twig = (new PageContentController())->setTwigEnvironment();
        $pageContent = PageContentDao::getById($id);
        if ($pageContent){
            echo $twig->render('page_content/edit_page_content.html.twig', ['pageContent'=>$pageContent]); 
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function deleteById(int $id){
        $twig = (new PageContentController())->setTwigEnvironment();
        $pageContent = PageContentDao::getById($id);
        if ($pageContent){
            echo $twig->render('page_content/delete_page_content.html.twig', ['pageContent'=>$pageContent]); 
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
