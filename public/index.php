<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
session_start();
function autoload ($class) { //Загрузка файлов
    $namespase = '';
    $dir = __DIR__.'/../';
    if($last = strripos($class,'\\'))
    {
      $namespase=substr($class,0,$last);
      $classname=substr($class,$last+1);
      $filename=$dir.$namespase.DIRECTORY_SEPARATOR;
    }
    $filename.=$classname.'.php';
    if(file_exists($filename)){
      require $filename;
    }
};

spl_autoload_register('autoload');
$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware= $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(function () use ($app) {
        $response = $app->getResponseFactory()->createResponse();
        $view = new \Libraries\View();
        $view->rendering("404");
        return $response
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html');
});

$app->group('/', function (RouteCollectorProxy $group) {

  $group->get('', function ($request, $response, array $args) {
    //Главаня страница
    //Значение category(Выбраная категория) и page(номер страницы)
      $Controller = new \Controller\AController;
      $Controller->set("index","index",$args);
      $Controller->run();
      return $response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
        });

        //   !!!УДАЛИТЬ    //////
    $group->get('/product/{id}', function ($request, $response, array $args) {
      //Информация о товаре
        $Controller = new \Controller\AController;
        $Controller->set("index","index",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          /////       /////
});

$app->group('/api', function (RouteCollectorProxy $group) {

    $group->get('/productAdd', function ($request, $response, array $args) {
      //Добавдения товара в корзину
      //Значения productID(id товара, ОБЯЗАТЕЛЬНО) и url(страница возврата, ОБЯЗАТЕЛЬНО)
        $Controller = new \Controller\AController;
        $Controller->set("api","AddСart",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
});

$app->group('/admin', function (RouteCollectorProxy $group) {

});

//$app->get('{dir}/{name}', function ($request, $response, array $args) {
    //require(__DIR__ . '/../Template/{dir}/{name}');
    //return $response
        //->withHeader('Content-Type', 'text/html')
        //->withStatus(200);
//});

$app->run();
var_dump($_COOKIE["cart"]);
