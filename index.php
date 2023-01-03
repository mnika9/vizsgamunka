<?php 

require __DIR__ .'/vendor/autoload.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\Home;
use App\admin\Controller\ManagerController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\admin\Controller\TitleController;
use App\admin\Controller\HousesController;
use App\publicPage\Controller\HomeController;
use App\admin\Controller\LoginController;
use App\admin\Controller\OwnerController;
use App\admin\Controller\AdminController;
use App\admin\Controller\SliderController;
use App\admin\Controller\PasswordController;
use App\publicPage\Controller\ContactController;
use App\admin\Controller\PictureController;
use App\publicPage\Controller\PageController;
use App\admin\Controller\PageContentController;




/******************PUBLIC PAGE******************/

Router::get('/', function() {
  (new HomeController())->indexAction();
});

/*******************FEJLESZTÉSRE VÁR *************/

Router::get('/bekesszentandras', function(Request $req, Response $res){
 return (new PageController())->list();
});

Router::get('/szarvas', function(Request $req, Response $res){
  return (new PageController())->listSzarvas();
 });

 Router::get('/akciosnapok', function(Request $req, Response $res){
  return (new PageController())->listaction();
 });

 Router::get('/hasznos', function(Request $req, Response $res){
  return (new PageController())->listaction();
 });


/****************** CONTACT ******************/

Router::get('/contact', function(Request $req, Response $res){
  (new ContactController())->list();
});

/******************ADMIN******************/

Router::get('/admin', function (Request $req, Response $res) {
  return (new AdminController())->indexStart();
});

/******************LOGIN******************/

Router::get('/login', function (Request $req, Response $res) {
  return ((new LoginController())->login());
});

Router::post('/login', function (Request $req, Response $res) {
  return (new LoginController())->adminLoginValidate();
});

/****************** MANAGER *****************/

Router::get('/manager', function(Request $req, Response $res){
  return (new ManagerController())->list();
});

Router::get('/managerAdd', function(Request $req, Response $res){
  return (new ManagerController())->add();
});

Router::post('/managerAdd', function(Request $req, Response $res){
  return (new ManagerController())->save();
});

Router::get('/managerEdit/([0-9]*)', function(Request $req, Response $res){
  (new ManagerController())->editById($req->params[0]);
});


Router::post('/managerEdit', function(Request $req, Response $res){
  (new ManagerController())->update();
});


Router::get('/managerDelete/([0-9]*)', function(Request $req, Response $res){
  (new ManagerController())->deleteById($req->params[0]);
});



Router::post('/managerDelete', function(Request $req, Response $res){
  return (new ManagerController())->delete();
});


/****************** JELSZÓKEZELÉS *****************/

Router::get('/passwords', function (Request $req, Response $res) {
  return (new PasswordController())->list();
});

Router::get('/passwordEdit/([0-9]*)', function (Request $req, Response $res) {
  (new PasswordController())->editById($req->params[0]);
});

Router::post('/passwordEdit', function (Request $req, Response $res) {
  (new PasswordController())->update();
});

/****************** TITLE *****************/

Router::get('/title', function (Request $req, Response $res){
  return (new TitleController())->list();
});


Router::get('/titleAdd', function(Request $req, Response $res){
  return (new TitleController())->add();
});

Router::post('/titleAdd', function(Request $req, Response $res){
  return (new TitleController())->save();
});


Router::get('/titleEdit/([0-9]*)', function(Request $req, Response $res){
  (new TitleController())->editById($req->params[0]);
});


Router::post('/titleEdit', function(Request $req, Response $res){
  (new TItleController())->update();
});


Router::get('/titleDelete/([0-9]*)', function(Request $req, Response $res){
  (new TitleController())->deleteById($req->params[0]);
});



Router::post('/titleDelete', function(Request $req, Response $res){
  return (new TitleController())->delete();
});


/************************* OWNER ****************************/

Router::get('/owner', function (Request $req, Response $res){
  return (new OwnerController())->list();
});


Router::get('/ownerAdd', function(Request $req, Response $res){
  return (new OwnerController())->add();
});

Router::post('/ownerAdd', function(Request $req, Response $res){
  return (new OwnerController())->save();
});


Router::get('/ownerEdit/([0-9]*)', function(Request $req, Response $res){
  (new OwnerController())->editById($req->params[0]);
});


Router::post('/ownerEdit', function(Request $req, Response $res){
  (new OwnerController())->update();
});


Router::get('/ownerDelete/([0-9]*)', function(Request $req, Response $res){
  (new OwnerController())->deleteById($req->params[0]);
});



Router::post('/ownerDelete', function(Request $req, Response $res){
  return (new OwnerController())->delete();
});



/************************* HOUSES ****************************/

Router::get('/houses', function(Request $req, Response $res){
  return (new HousesController())->list();
});

Router::get('/housesAdd', function(Request $req, Response $res){
  return (new HousesController())->add();
});

Router::post('/housesAdd', function(Request $req, Response $res){
  return (new HousesController())->save();
});

Router::get('/housesEdit/([0-9]*)', function(Request $req, Response $res){
  (new HousesController())->editById($req->params[0]);
});


Router::post('/housesEdit', function(Request $req, Response $res){
  (new HousesController())->update();
});


Router::get('/housesDelete/([0-9]*)', function(Request $req, Response $res){
  (new HousesController())->deleteById($req->params[0]);
});



Router::post('/housesDelete', function(Request $req, Response $res){
  return (new HousesController())->delete();
});



/************************* SLIDERS ****************************/

Router::get('/slider', function(Request $req, Response $res){
  return (new SliderController())->list();
});

Router::get('/sliderAdd', function(Request $req, Response $res){
  return (new SliderController())->add();
});

Router::post('/sliderAdd', function(Request $req, Response $res){
  return (new SliderController())->save();
});

Router::get('/sliderEdit/([0-9]*)', function(Request $req, Response $res){
  (new SliderController())->editById($req->params[0]);
});


Router::post('/sliderEdit', function(Request $req, Response $res){
  (new SliderController())->update();
});


Router::get('/sliderDelete/([0-9]*)', function(Request $req, Response $res){
  (new SliderController())->deleteById($req->params[0]);
});


Router::post('/sliderDelete', function(Request $req, Response $res){
  return (new SliderController())->delete();
});


App::run();

?>


