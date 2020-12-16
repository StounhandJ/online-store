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
    $this->IMGproduct = __DIR__.'/../Template/images/product/';
    $this->IMGmaterial = __DIR__.'/../Template/images/material/';
  }
  
  function __call($name, $args)
  {
  	$this->before($args[0], $args[1]);
  	if(!$this->checkAdmin() && $name!="Login" && $name!="loginAPI")
  	{
  		 return $this->view->error404();
  	}
  	return $this->{$name}();
  }
  
	function resize_photo($path,$filename,$filesize,$type,$tmp_name)
	{
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
    if ($_SESSION['type']=="admin" && $_SESSION['HTTP_USER_AGENT']==$this->SERVER["HTTP_USER_AGENT"]) {
      return True;
    }
    elseif ($this->COOKIE["AuthAdmin"]==hash('ripemd320',$this->login."|".$this->SERVER["HTTP_USER_AGENT"])) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$this->SERVER["HTTP_USER_AGENT"];
      return True;
    }
    unset($this->$COOKIE['AuthAdmin']);
    setcookie('AuthAdmin', null, -1, '/');
    unset($_SESSION['type']);
    unset($_SESSION['HTTP_USER_AGENT']);
    session_destroy();
    return false;
  }

  protected function index()  //Главаня страница админки
  {
    $data["info"]=$this->InformationM->get();
    $data["url"]=$this->local;
    return $this->view->rendering("Admin/main-mebel",$data, $HeaderFooter = false);
  }

  protected function Login()  //Страница для Авторизация в админку
  {
    if ($this->checkAdmin()) {
      $this->view->redirect($this->local);
      echo "string";
    }
    $data["url"]=$this->local;
    return $this->view->rendering("Admin/Login-mebel",$data, $HeaderFooter = false);
  }

  protected function Add()  //Страница для Добавления данных в админку
  {
    $data["AllCategory"]=$this->GoodsM->getAllCategory();
    $data["url"]=$this->local;
    return $this->view->rendering("Admin/Add-mebel",$data, $HeaderFooter = false);
  }

  protected function Change()  //Страница для Изменение данныв в админке
  {
    $data["AllCategory"]=$this->GoodsM->getAllCategory();
    $data["AllProducts"]=$this->GoodsM->getAllGoods();
    $data["AllMaterials"]=$this->MaterialsM->getAllMaterial();
    $data["url"]=$this->local;
    return $this->view->rendering("Admin/Change-mebel",$data, $HeaderFooter = false);
  }
  
   protected function Del()  // Страница для Удаление данных в админке
  {
    $data["AllProducts"]=$this->GoodsM->getAllGoods();
    $data["AllMaterials"]=$this->MaterialsM->getAllMaterial();
    $data["url"]=$this->local;
    return $this->view->rendering("Admin/Delete-mebel",$data, $HeaderFooter = false);
  }

 //--------API часть админки----------//

  protected function loginAPI()  //Авторизация
  {
    if ($this->POST["login"]==$this->login && $this->POST["password"]==$this->password) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$this->SERVER["HTTP_USER_AGENT"];
      $text = $this->login."|".$this->SERVER["HTTP_USER_AGENT"];
      setcookie("AuthAdmin", hash('ripemd320',$text),time()+60*60*24*7);
      return $this->view->renderingAPI(['code'=>200,"mes"=>"Успешный вход"]);
    }
    else {
      return $this->view->renderingAPI(['code'=>404,"mes"=>"Данные не найдены"]);
    }
  }
  
  protected function InfoUpdate() //Обновить информацию на сайте
  {
      $this->InformationM->set($this->POST);
      return $this->view->renderingAPI(['code'=>202,"mes"=>"Основная информация на сайте обновленна"]);
  }
  
  //------API admin Product------//

  protected function AddProductAPI() //Добавить продукт
  {
      $file = $this->FILE['pictures'];
      $facade=($this->POST["facade"]=="1")? true : false;
      $name = $this->POST["name"];
      $category = $this->POST["category"];
      $description = $this->POST["description"];
      $price = number_format($this->POST["price"], 0, ',', ' ') . " р.";
      $nameIMG = hash('ripemd128',$name.$description);
      if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
      {
      	$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
      }
      $AllCategory = $this->GoodsM->createProduct($name,$price,$description,$category,$facade,$nameIMG);
      return $this->view->renderingAPI(['code'=>200,'mes'=>'Товар создан']);
  }

  protected function UpdateProductAPI() //Редактировать продукт
  {
      $nameIMG=null;
      if(isset($this->FILE['pictures']))
      {
      	$file = $this->FILE['pictures'];
      	$id = $this->POST['id'] ?? "123";
      	$nameIMG = hash('ripemd128',$file->getFilePath().$id);
    	if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
    	{
      		$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
    	}
    	$oldIMG = $this->POST['OLDpictures'];
    	$f = "$this->IMGproduct/$oldIMG.jpg";
    	if(file_exists($f)){
			unlink($f);
		}
      }
      $id = $this->POST['id'];
      $price = (isset($this->POST["price"]))?number_format($this->POST["price"], 0, ',', ' ') . " р.":null;
      $this->GoodsM->updateProduct($id,$this->POST['name'],$price,$this->POST['description'],$this->POST['category'],$this->POST['facade'],$nameIMG);
      return $this->view->renderingAPI(['code'=>200,'mes'=>"Товар обновлен {$id}"]);
  }

  protected function DelProductAPI() //Удалить продукт
  {
	  $oldIMG = $this->GoodsM->getInfoProductID($this->POST['id'])["img"];
	  $f = "$this->IMGproduct/$oldIMG.jpg";
	  if(file_exists($f)){
		unlink($f);
	  }
	  $id = $this->POST['id'];
	  $this->GoodsM->deleteProduct($id);
	  return $this->view->renderingAPI(['code'=>200,'mes'=>"Товар удален {$id}"]);
  }
  
  //------API admin Material------//

	protected function AddMaterialAPI() //Добавить материал
	{
		$file = $this->FILE['pictures'];
		$name = $this->POST["name"];
		$description = $this->POST["description"];
		$nameIMG = hash('ripemd128',$name.$description);
		if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
		{
	  		$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
		}
		$AllCategory = $this->MaterialsM->createMaterial($name,$description,$nameIMG);
		return $this->view->renderingAPI(['code'=>200,'mes'=>"Материал добавлен"]);
	}
	  
	protected function UpdateMaterialAPI() //Редактировать материал
	{
		$nameIMG=null;
		if(isset($this->FILE['pictures']))
		{
			$file = $this->FILE['pictures'];
			$id = $this->POST['id'] ?? "123";
			$nameIMG = hash('ripemd128',$file->getFilePath().$id);
			if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
			{
				$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
			}
			$oldIMG = $this->POST['OLDpictures'];
			$f = "$this->IMGmaterial/$oldIMG.jpg";
			if(file_exists($f))
			{
				unlink($f);
			}
		}
		$id = $this->POST['id'];
		$this->MaterialsM->updateMaterial($id,$this->POST['name'],$this->POST['description'],$nameIMG);
		return $this->view->renderingAPI(['code'=>200,'mes'=>"Материал обновлен {$id}"]);
	}
	  
	protected function DelMaterialAPI() //Удалить материал
	{
		$oldIMG = $this->MaterialsM->getInfoMaterialID($this->POST['id'])["img"];
		$f = "$this->IMGmaterial/$oldIMG.jpg";
    	if(file_exists($f)){
			unlink($f);
		}
		$this->MaterialsM->deleteMaterial($this->POST['id']);
		return $this->view->renderingAPI(['code'=>200,'mes'=>"Материал {$id} удален"]);
	}
}


 ?>
