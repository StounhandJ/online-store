<?php
namespace Controller;

class AController
{
  protected $controller;
  protected $method;
  protected $response;
  public static $res="123";

  function __construct()
  {

  }
  

  function set($controll,$method,$array=NULL) //Устанавливает нужный контроллер и метод для контроллера
  {
    $path = '\Controller\\'.$controll . 'Controller'; //Название файла и класса
    $this->controller = new $path($request,$response);
    $this->method = $method;
    $this->args = $array;
  }
  
  function run() //Запускает класс с нужным методом
  {
    $meth = $this->method;
    return $this->controller->$meth();
  }
  
  function addResponse($response)
  {
  	$this->response = $response;
  }
  
  function codeHTML200()
  {
  	return $this->response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
  }
  
  function codeHTML404()
  {
  	return $this->response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
  }
  
    function codeJSON200()
  {
  	return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
  }
  
  function codeJSON404()
  {
  	return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
  }

}

 ?>
