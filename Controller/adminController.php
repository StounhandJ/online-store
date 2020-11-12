<?php
namespace Controller;
use Slim\Factory\AppFactory;

class adminController extends AController
{

  function __construct()
  {
    $this->login = "adStoun";
    $this->password = "12345";
    $this->local = "admin";
    $this->view = new \Libraries\View();
  }

  function checkAdmin()  //Проверка на админа, True если админ
  {
    if ($_SESSION['type']=="admin" && $_SESSION['HTTP_USER_AGENT']==$_SERVER["HTTP_USER_AGENT"]) {
      return True;
    }
    elseif ($_COOKIE["AuthAdmin"]==hash('ripemd320',$this->login."|".$_SERVER["HTTP_USER_AGENT"])) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$_SERVER["HTTP_USER_AGENT"];
      return True;
    }
    unset($_COOKIE['AuthAdmin']);
    setcookie('AuthAdmin', null, -1, '/');
    unset($_SESSION['type']);
    unset($_SESSION['HTTP_USER_AGENT']);
    session_destroy();
    return false;
  }

  function index()
  {
    if (!$this->checkAdmin()) {
      $this->view->rendering("404");
      return;
    }
    echo "Admin";
  }

  function Login()
  {
    if ($this->checkAdmin()) {
      $this->view->redirect($this->local);
      echo "string";
    }
    $this->view->rendering("Admin/Login-mebel");
  }

 //--------API часть админки----------//

  function loginAPI()  //Сама авторизация
  {
    if ($_POST["login"]==$this->login && $_POST["password"]==$this->password) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$_SERVER["HTTP_USER_AGENT"];
      setcookie("AuthAdmin", hash('ripemd320',$this->login."|".$_SERVER["HTTP_USER_AGENT"]),time()+60*60*24*7);
      $this->view->redirect($this->local);
    }
    else {
      $this->view->redirect($this->local."/login");
    }
    echo "string";
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
      $OriginName = $_POST["OriginName"];
      if (!$this->checkAdmin() || !isset($OriginName)) {
        $this->view->rendering("404");
        return;
      }
      $model = new \Model\ListGoods;
      $data = $model->getInfoProductName($OriginName);
      $name = $_GET["name"] ?? $data["name"];
      $price = $_GET["price"] ?? $data["price"];
      $description = $_GET["description"] ?? $data["description"];
      $categor = $_GET["categor"] ?? $data["categor"];
      $img = "test";
      $model->setInfoProduct($OriginName,$name,$price,$description,$category,$img);
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
