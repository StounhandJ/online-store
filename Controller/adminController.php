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
    $info = new \Model\InformationSite;
    $data["info"]=$info->get();
    $data["url"]=$this->local;
    $this->view->rendering("Admin/main-mebel",$data);
  }

  function Login()
  {
    if ($this->checkAdmin()) {
      $this->view->redirect($this->local);
      echo "string";
    }
    $data["url"]=$this->local;
    $this->view->rendering("Admin/Login-mebel",$data);
  }

  function Change()
  {
    if (!$this->checkAdmin()) {
      $this->view->rendering("404");
      return;
    }
    $model = new \Model\ListGoods;
    $data["AllCategory"]=$model->getAllCategory();
    $data["AllProducts"]=$model->getAllGoods();
    $data["url"]=$this->local;
    $this->view->rendering("Admin/Change-mebel",$data);
  }

  function Add()
  {
    if (!$this->checkAdmin()) {
      $this->view->rendering("404");
      return;
    }
    $model = new \Model\ListGoods;
    $data["AllCategory"]=$model->getAllCategory();
    $data["url"]=$this->local;
    $this->view->rendering("Admin/Add-mebel",$data);
  }
  
   function Del()
  {
    if (!$this->checkAdmin()) {
      $this->view->rendering("404");
      return;
    }
    $model = new \Model\ListGoods;
    $data["AllProducts"]=$model->getAllGoods();
    $data["url"]=$this->local;
    $this->view->rendering("Admin/Delete-mebel",$data);
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
  
  function InfoUpdate() //Добавить продукт
  {
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }
      $info = new \Model\InformationSite;
      $info->set($_POST);
  }

  function AddProductAPI() //Добавить продукт
  {
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }
      $facade=($_POST["facade"]=="1")? true : false;
      $name = $_POST["name"];
      $category = $_POST["category"];
      $description = $_POST["description"];
      $price = $_POST["price"];
      $nameIMG = hash('ripemd128',$name);
      $uploads_dir = __DIR__.'/../Template/images/product';
      move_uploaded_file($_FILES["pictures"]["tmp_name"], "$uploads_dir/$nameIMG.jpg");
	  $model = new \Model\ListGoods;
      $AllCategory = $model->creatProduct($name,$price,$description,$category,$facade,$nameIMG);
  }

  function UpdateProductAPI() //Редактировать продукт
  {
      $OriginName = $_POST["OriginName"];
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }
      $nameIMG=null;
      if(isset($_FILES["pictures"]))
      {
      	$nameIMG = hash('ripemd128',$_FILES["pictures"]["tmp_name"]);
    	$uploads_dir = __DIR__.'/../Template/images/product';
    	move_uploaded_file($_FILES["pictures"]["tmp_name"], "$uploads_dir/$nameIMG.jpg");
    	$oldIMG = $_POST['OLDpictures'];
    	$f = "$uploads_dir/$oldIMG.jpg";
    	var_dump($f);
    	var_dump(file_exists($f));
    	if(file_exists($f)){
			unlink($f);
		}
      }
      $model = new \Model\ListGoods;
      $model->setInfoProduct($_POST['id'],$_POST['name'],$_POST['price'],$_POST['description'],$_POST['category'],$_POST['facade'],$nameIMG);
  }

  function DelProductAPI() //Удалить продукт
  {
      if (!$this->checkAdmin() || !isset($_POST['id'])) {
        $this->view->rendering("404");
        return;
      }
	  $model = new \Model\ListGoods;
	  $model->deleteProduct($_POST['id']);
  }

}


 ?>
