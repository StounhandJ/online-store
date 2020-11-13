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

  $group->get('/category.get', function ($request, $response, array $args) {
    //Возврат всех категорий товаров
    $Controller = new \Controller\AController;
    $Controller->set("api","CategoryGet",$args);
    $Controller->run();
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
      });

    $group->get('/product.get', function ($request, $response, array $args) {
        //Возврат всех товаров по категории
        //Значения category(название категории, ОБЯЗАТЕЛЬНО)
        $Controller = new \Controller\AController;
        $Controller->set("api","ProductGet",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
          });

    $group->get('/product.info', function ($request, $response, array $args) {
        //Возврат информацию о товаре по названию
        //Значения id(id товара, ОБЯЗАТЕЛЬНО)
        $Controller = new \Controller\AController;
        $Controller->set("api","ProductInfo",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
          });

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

  $group->get('', function ($request, $response, array $args) {
      $Controller = new \Controller\AController;
      $Controller->set("admin","index",$args);
      $Controller->run();
      return $response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
        });

  $group->get('/login', function ($request, $response, array $args) {
      $Controller = new \Controller\AController;
      $Controller->set("admin","Login",$args);
      $Controller->run();
      return $response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
        });

    $group->get('/change', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","Change",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
    $group->get('/add', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","Add",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          
    $group->get('/delete', function ($request, $response, array $args) {
	    $Controller = new \Controller\AController;
	    $Controller->set("admin","Del",$args);
	    $Controller->run();
	    return $response
	        ->withHeader('Content-Type', 'text/html')
	        ->withStatus(200);
	      });
	      
			//------API admin------//
    $group->post('/admin.login', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","loginAPI",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          
    $group->post('/info.update', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","InfoUpdate",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          
    $group->post('/product.add', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","AddProductAPI",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          
    $group->post('/product.update', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","UpdateProductAPI",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          
});

            //-------------------------//
$app->run();
