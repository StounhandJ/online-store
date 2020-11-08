<?php
namespace Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class indexController extends AController
{

  function __construct($request,$response)
  {
    $this->request=$request;
    $this->response=$response;
  }


}


 ?>
