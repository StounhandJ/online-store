<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;
require __DIR__ . '/../vendor/autoload.php';

session_start();
$app = AppFactory::create();
        //---------Подключение классов---------//
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

        //-------------------------------//


          //Ошибка при остувие страницы//
// $app->addRoutingMiddleware();
// $errorMiddleware= $app->addErrorMiddleware(true, true, true);
// $errorMiddleware->setDefaultErrorHandler(function () use ($app) {
//         $response = $app->getResponseFactory()->createResponse();
//         $view = new \Libraries\View();
//         $view->rendering("404");
//         return $response
//             ->withStatus(404)
//             ->withHeader('Content-Type', 'text/html');
// });

        //-------------------------------//


          //---------Главная---------//

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
    $group->get('product', function ($request, $response, array $args) {
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

            //-------------------------//


            //---------API---------//

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

            //-------------------------//


            //---------Админ панель---------//

$app->group('/admin', function (RouteCollectorProxy $group) {

  $group->get('/login', function ($request, $response, array $args) use ($app) {
    $routeParser = $app->getRouteCollector()->getRouteParser();
    echo $routeParser->urlFor("login");
      $Controller = new \Controller\AController;
      $Controller->set("admin","Test",$args);
      $Controller->run();
      return $response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
        })->setName("login");
});

            //-------------------------//

$routeParser = $app->getRouteCollector()->getRouteParser();
echo $routeParser->urlFor("login");
$app->run();
