<?php
namespace Controller;

class AController
{
  protected $request;
  protected $response;
  public $view;
  public $GET;
  public $POST;
  public $COOKIE;

  function __construct()
  {

  }
  
  function set_request($request)
  {
	$this->GET = $request->getQueryParams();
	$this->POST = $request->getParsedBody();
	$this->COOKIE = $request->getCookieParams();
  	$this->request = $request;
  }
  
  function set_response($response)
  {
  	$this->response = $response;
  }
  
  function get_request()
  {
  	return $this->request;
  }
  
  function get_response()
  {
  	return $this->response;
  }
  
  function before($request, $response)
  {
  	$this->set_request($request);
  	$this->set_response($response);
  	$this->view = new \Libraries\View($this->response);
  }

}

 ?>
