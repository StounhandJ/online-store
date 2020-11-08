<?php
namespace Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class adminController extends AController
{

  function __construct($request,$response)
  {
    $this->request=$request;
    $this->response=$response;
  }

  function checkAdmin()  //Проверка на админа
  {
    if ($_SESSION['type']=="admin") {
      return True;
    }
    return false;
  }


}


 ?>
