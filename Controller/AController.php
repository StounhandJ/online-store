<?php
namespace Controller;

class AController
{
  protected $controller;
  protected $method;

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

}

 ?>
