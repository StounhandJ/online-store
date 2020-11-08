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
// $app->addRoutingMiddleware();
// $errorMiddleware= $app->addErrorMiddleware(true, true, true);
// $errorMiddleware->setDefaultErrorHandler(function () use ($app) {
//         $response = $app->getResponseFactory()->createResponse();
//         $response->getBody()->write('Page not found');
//         return $response
//             ->withStatus(404)
//             ->withHeader('Content-Type', 'text/html');
// });

$app->group('/', function (RouteCollectorProxy $group) {
  $group->get('', function ($request, $response, array $args) {
    $response->getBody()->write('<h1>Эта страница в разработке.<br> Для использования api перейдите на эту <a href="/api">страничку</a>');
      return $response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
        });
});

$app->group('/api', function (RouteCollectorProxy $group) {

});

$app->group('/admin', function (RouteCollectorProxy $group) {

});

$app->run();
