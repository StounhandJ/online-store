<?php
namespace Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class adminController extends AController
{

  function __construct()
  {
    $this->login = "adStoun";
    $this->password = "12345";
    $this->view = new \Libraries\View();
  }

  function checkAdmin()  //Проверка на админа, True если админ
  {
    if ($_SESSION['type']=="admin" && $_SESSION['HTTP_USER_AGENT']==$_SERVER["HTTP_USER_AGENT"]) {
      return True;
    }
    elseif ($_COOKIE["AuthAdmin"]==hash('ripemd320',$this->login."|".$_SERVER["HTTP_USER_AGENT"])) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$_SERVER["HTTP_USER_AGENT"]
      return True;
    }
    unset($_COOKIE['AuthAdmin']);
    setcookie('AuthAdmin', null, -1, '/');
    unset($_SESSION['type']);
    unset($_SESSION['HTTP_USER_AGENT']);
    session_destroy();
    return false;
  }

  function loginAPI()  //Сама авторизация
  {
    if ($_POST["login"]==$this->login && $_POST["password"]==$this->password) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$_SERVER["HTTP_USER_AGENT"]
      setcookie("AuthAdmin", hash('ripemd320',$this->login."|".$_SERVER["HTTP_USER_AGENT"]),time()+60*60*24*7);
    }
  }

  function AddProductAPI() //Добавить продукт
  {
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }

  }

  function RedProductAPI() //Редактировать продукт
  {
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }

  }

  function DelProductAPI() //Удалить продукт
  {
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }

  }

}


 ?>
