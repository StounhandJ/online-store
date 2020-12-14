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
        //-------------------------------//

          //---------Главная---------//

$app->group('/', function (RouteCollectorProxy $group) {
	
	$group->get('',"\Controller\indexController:index");  //Главная страница параметры (category и page)
  
	$group->get('materials', "\Controller\indexController:materials");  //Страница с материалами параметры (page)
        
    $group->get('montage', "\Controller\indexController:montage");  //Страница с информацие о монтаже
        
    $group->get('cart', "\Controller\indexController:cart");  //Корзина
    
});

            //-------------------------//


            //---------API---------//

$app->group('/api', function (RouteCollectorProxy $group) {
	
					//------API информации о товарах------//
	$group->get('/info.get', "\Controller\apiController:InfoGet");  //Возвращает основную информацию о сайте

  $group->get('/category.get',"\Controller\apiController:CategoryGet");  //Возвращает имена всех категорий

    $group->get('/product.info', "\Controller\apiController:ProductInfo");  //Возвращает информацию о товаре по ID параметры (id)
    
    $group->get('/material.info', "\Controller\apiController:MaterialInfo");  //Возвращает информацию о материале по ID параметры (id)

					//------API корзины------//
	$group->post('/cartPush', "\Controller\apiController:СartPush"); //Отправляет заказ на почту параметры (name,phone,email,address,comment), а так же наличиие cookie (cart)
	
    $group->post('/productAdd', "\Controller\apiController:AddСart"); //Добавляет товар в корзину по id параметры (productID)
          
    $group->post('/productAddmaterial', "\Controller\apiController:AddСartMaterial"); //Добавляет товару материал в корзине параметры (productID,facade,materialID)
    
    $group->post('/productAddcolor', "\Controller\apiController:AddСartColor"); //Добавляет товару цвет в корзине параметры (productID,facade,color)
    
    $group->post('/productDel', "\Controller\apiController:DelСart");  //Удаляет товар из корзины по id параметры (productID)

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
          
          //------API admin Product------//
          
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
          
    $group->post('/product.delete', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","DelProductAPI",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          
          //------API admin Material------//
          
    $group->post('/material.add', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","AddMaterialAPI",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
    $group->post('/material.update', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","UpdateMaterialAPI",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });
          
    $group->post('/material.delete', function ($request, $response, array $args) {
        $Controller = new \Controller\AController;
        $Controller->set("admin","DelMaterialAPI",$args);
        $Controller->run();
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
          });          
});
            //-------------------------//
$app->run();
