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
    $this->IMGproduct = __DIR__.'/../Template/images/product/';
    $this->IMGmaterial = __DIR__.'/../Template/images/material/';
  }
  
function resize_photo($path,$filename,$filesize,$type,$tmp_name){
    $quality = 50;
    $size = 300;
    if($filesize>$size){
        switch($type){
            case 'image/jpeg': $source = imagecreatefromjpeg($tmp_name); break;
            case 'image/png': $source = imagecreatefrompng($tmp_name); break; 
            case 'image/gif': $source = imagecreatefromgif($tmp_name); break;
            default: return false;
        }
        imagejpeg($source, $path.$filename, $quality);
        imagedestroy($source);
        return true;
    }
    else return false;     
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

  function Change()
  {
    if (!$this->checkAdmin()) {
      $this->view->rendering("404");
      return;
    }
    $model = new \Model\ListGoods;
    $model2 = new \Model\ListMaterials;
    $data["AllCategory"]=$model->getAllCategory();
    $data["AllProducts"]=$model->getAllGoods();
    $data["AllMaterials"]=$model2->getAllMaterial();
    $data["url"]=$this->local;
    $this->view->rendering("Admin/Change-mebel",$data);
  }
  
   function Del()
  {
    if (!$this->checkAdmin()) {
      $this->view->rendering("404");
      return;
    }
    $model = new \Model\ListGoods;
    $model2 = new \Model\ListMaterials;
    $data["AllProducts"]=$model->getAllGoods();
    $data["AllMaterials"]=$model2->getAllMaterial();
    $data["url"]=$this->local;
    $this->view->rendering("Admin/Delete-mebel",$data);
  }

 //--------API часть админки----------//

  function loginAPI()  //Авторизация
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
  
  function InfoUpdate() //Обновить информацию на сайте
  {
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }
      $info = new \Model\InformationSite;
      $info->set($_POST);
  }
  
  //------API admin Product------//

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
      $price = number_format($_POST["price"], 0, ',', ' ') . " р.";
      $nameIMG = hash('ripemd128',$name.$description);
      if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$_FILES['pictures']['size'],$_FILES['pictures']['type'],$_FILES['pictures']['tmp_name']))
      {
      	move_uploaded_file($_FILES["pictures"]["tmp_name"], "$this->IMGproduct/$nameIMG.jpg");
      }
	  $model = new \Model\ListGoods;
      $AllCategory = $model->createProduct($name,$price,$description,$category,$facade,$nameIMG);
  }

  function UpdateProductAPI() //Редактировать продукт
  {
      if (!$this->checkAdmin()) {
        $this->view->rendering("404");
        return;
      }
      $nameIMG=null;
      if(isset($_FILES["pictures"]))
      {
      	$id = $_POST['id'] ?? "123";
      	$nameIMG = hash('ripemd128',$_FILES["pictures"]["tmp_name"].$id);
    	if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$_FILES['pictures']['size'],$_FILES['pictures']['type'],$_FILES['pictures']['tmp_name']))
    	{
      		move_uploaded_file($_FILES["pictures"]["tmp_name"], "$this->IMGproduct/$nameIMG.jpg");
    	}
    	$oldIMG = $_POST['OLDpictures'];
    	$f = "$this->IMGproduct/$oldIMG.jpg";
    	if(file_exists($f)){
			unlink($f);
		}
      }
      $model = new \Model\ListGoods;
      $model->updateProduct($_POST['id'],$_POST['name'],number_format($_POST["price"], 0, ',', ' ') . " р.",$_POST['description'],$_POST['category'],$_POST['facade'],$nameIMG);
  }

  function DelProductAPI() //Удалить продукт
  {
      if (!$this->checkAdmin() || !isset($_POST['id'])) {
        $this->view->rendering("404");
        return;
      }
      $model = new \Model\ListGoods;
	  $oldIMG = $model->getInfoProductID($_POST['id'])["img"];
	  $f = "$this->IMGproduct/$oldIMG.jpg";
	  if(file_exists($f)){
		unlink($f);
	  }
	  $model->deleteProduct($_POST['id']);
  }
  
  //------API admin Material------//

	function AddMaterialAPI() //Добавить материал
	  {
	      if (!$this->checkAdmin()) {
	        $this->view->rendering("404");
	        return;
	      }
	      $name = $_POST["name"];
	      $description = $_POST["description"];
	      $nameIMG = hash('ripemd128',$name.$description);
	      if(!$this->resize_photo($this->IMGmaterial,"$nameIMG.jpg",$_FILES['pictures']['size'],$_FILES['pictures']['type'],$_FILES['pictures']['tmp_name']))
    	{
      		move_uploaded_file($_FILES["pictures"]["tmp_name"], "$this->IMGmaterial/$nameIMG.jpg");
    	}
		  $model = new \Model\ListMaterials;
	      $AllCategory = $model->createMaterial($name,$description,$nameIMG);
	  }
	  
	  function UpdateMaterialAPI() //Редактировать материал
		{
	      if (!$this->checkAdmin()) {
	        $this->view->rendering("404");
	        return;
	      }
	      $nameIMG=null;
	      if(isset($_FILES["pictures"]))
	      {
	      	$id = $_POST['id'] ?? "123";
	      	$nameIMG = hash('ripemd128',$_FILES["pictures"]["tmp_name"].$id);
	    	if(!$this->resize_photo($this->IMGmaterial,"$nameIMG.jpg",$_FILES['pictures']['size'],$_FILES['pictures']['type'],$_FILES['pictures']['tmp_name']))
    		{
      			move_uploaded_file($_FILES["pictures"]["tmp_name"], "$this->IMGmaterial/$nameIMG.jpg");
    		}
	    	$oldIMG = $_POST['OLDpictures'];
	    	$f = "$this->IMGmaterial/$oldIMG.jpg";
	    	if(file_exists($f)){
				unlink($f);
			}
	      }
	      $model = new \Model\ListMaterials;
	      $model->updateMaterial($_POST['id'],$_POST['name'],$_POST['description'],$nameIMG);
	  }
	  
	function DelMaterialAPI() //Удалить материал
	{
		if (!$this->checkAdmin() || !isset($_POST['id'])) {
			$this->view->rendering("404");
    		return;
		}
		$model = new \Model\ListMaterials;
		$oldIMG = $model->getInfoMaterialID($_POST['id'])["img"];
		$f = "$this->IMGmaterial/$oldIMG.jpg";
    	if(file_exists($f)){
			unlink($f);
		}
		$model->deleteMaterial($_POST['id']);
	}
}


 ?>
