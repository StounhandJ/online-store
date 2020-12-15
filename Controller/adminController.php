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

  function checkAdmin($request)  //Проверка на админа, True если админ
  {
  	$COOKIE = $request->getCookieParams();
  	$SERVER = $request->getServerParams();
    if ($_SESSION['type']=="admin" && $_SESSION['HTTP_USER_AGENT']==$SERVER["HTTP_USER_AGENT"]) {
      return True;
    }
    elseif ($COOKIE["AuthAdmin"]==hash('ripemd320',$this->login."|".$SERVER["HTTP_USER_AGENT"])) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$SERVER["HTTP_USER_AGENT"];
      return True;
    }
    unset($COOKIE['AuthAdmin']);
    setcookie('AuthAdmin', null, -1, '/');
    unset($_SESSION['type']);
    unset($_SESSION['HTTP_USER_AGENT']);
    session_destroy();
    return false;
  }

  function index($request, $response)  //Главаня страница админки
  {
    if (!$this->checkAdmin($request)) {
      return $this->view->error404($response);
    }
    $info = new \Model\InformationSite;
    $data["info"]=$info->get();
    $data["url"]=$this->local;
    return $this->view->rendering($response,"Admin/main-mebel",$data, $HeaderFooter = false);
  }

  function Login($request, $response)  //Страница для Авторизация в админку
  {
    if ($this->checkAdmin($request)) {
      $this->view->redirect($this->local);
      echo "string";
    }
    $data["url"]=$this->local;
    return $this->view->rendering($response,"Admin/Login-mebel",$data, $HeaderFooter = false);
  }

  function Add($request, $response)  //Страница для Добавления данных в админку
  {
    if (!$this->checkAdmin($request)) {
      return $this->view->error404($response);
    }
    $model = new \Model\ListGoods;
    $data["AllCategory"]=$model->getAllCategory();
    $data["url"]=$this->local;
    return $this->view->rendering($response,"Admin/Add-mebel",$data, $HeaderFooter = false);
  }

  function Change($request, $response)  //Страница для Изменение данныв в админке
  {
    if (!$this->checkAdmin($request)) {
      return $this->view->error404($response);
    }
    $model = new \Model\ListGoods;
    $model2 = new \Model\ListMaterials;
    $data["AllCategory"]=$model->getAllCategory();
    $data["AllProducts"]=$model->getAllGoods();
    $data["AllMaterials"]=$model2->getAllMaterial();
    $data["url"]=$this->local;
    return $this->view->rendering($response,"Admin/Change-mebel",$data, $HeaderFooter = false);
  }
  
   function Del($request, $response)  // Страница для Удаление данных в админке
  {
    if (!$this->checkAdmin($request)) {
      return $this->view->error404($response);
    }
    $model = new \Model\ListGoods;
    $model2 = new \Model\ListMaterials;
    $data["AllProducts"]=$model->getAllGoods();
    $data["AllMaterials"]=$model2->getAllMaterial();
    $data["url"]=$this->local;
    return $this->view->rendering($response,"Admin/Delete-mebel",$data, $HeaderFooter = false);
  }

 //--------API часть админки----------//

  function loginAPI($request, $response)  //Авторизация
  {
    if ($request->getParsedBody()["login"]==$this->login && $request->getParsedBody()["password"]==$this->password) {
      $_SESSION['type']="admin";
      $_SESSION['HTTP_USER_AGENT']=$request->getServerParams()["HTTP_USER_AGENT"];
      setcookie("AuthAdmin", hash('ripemd320',$this->login."|".$request->getServerParams()["HTTP_USER_AGENT"]),time()+60*60*24*7);
      $this->view->redirect($this->local);
    }
    else {
      $this->view->redirect($this->local."/login");
    }
    echo "string";
  }
  
  function InfoUpdate($request, $response) //Обновить информацию на сайте
  {
  	if (!$this->checkAdmin($request)) {
      return $this->view->error404($response);
    }
      $info = new \Model\InformationSite;
      $info->set($request->getParsedBody());
  }
  
  //------API admin Product------//

  function AddProductAPI($request, $response) //Добавить продукт
  {
      if (!$this->checkAdmin($request)) {
    	return $this->view->error404($response);
      }
      $file = $request->getUploadedFiles()['pictures'];
      $facade=($request->getParsedBody()["facade"]=="1")? true : false;
      $name = $request->getParsedBody()["name"];
      $category = $request->getParsedBody()["category"];
      $description = $request->getParsedBody()["description"];
      $price = number_format($request->getParsedBody()["price"], 0, ',', ' ') . " р.";
      $nameIMG = hash('ripemd128',$name.$description);
      if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
      {
      	$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
      }
	  $model = new \Model\ListGoods;
      $AllCategory = $model->createProduct($name,$price,$description,$category,$facade,$nameIMG);
      return $this->view->renderingAPI($response, ['code'=>200,'mes'=>'Товар создан']);
  }

  function UpdateProductAPI($request, $response) //Редактировать продукт
  {
      if (!$this->checkAdmin($request)) {
    	return $this->view->error404($response);
      }
      $nameIMG=null;
      if(isset($request->getUploadedFiles()['pictures']))
      {
      	$file = $request->getUploadedFiles()['pictures'];
      	$id = $request->getParsedBody()['id'] ?? "123";
      	$nameIMG = hash('ripemd128',$file->getFilePath().$id);
    	if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
    	{
      		$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
    	}
    	$oldIMG = $request->getParsedBody()['OLDpictures'];
    	$f = "$this->IMGproduct/$oldIMG.jpg";
    	if(file_exists($f)){
			unlink($f);
		}
      }
      $model = new \Model\ListGoods;
      $id = $request->getParsedBody()['id'];
      $price = (isset($request->getParsedBody()["price"]))?number_format($request->getParsedBody()["price"], 0, ',', ' ') . " р.":null;
      $model->updateProduct($id,$request->getParsedBody()['name'],$price,$request->getParsedBody()['description'],$request->getParsedBody()['category'],$request->getParsedBody()['facade'],$nameIMG);
      return $this->view->renderingAPI($response, ['code'=>200,'mes'=>"Товар обновлен {$id}"]);
  }

  function DelProductAPI($request, $response) //Удалить продукт
  {
      if (!$this->checkAdmin($request)) {
    	return $this->view->error404($response);
      }
      $model = new \Model\ListGoods;
	  $oldIMG = $model->getInfoProductID($request->getParsedBody()['id'])["img"];
	  $f = "$this->IMGproduct/$oldIMG.jpg";
	  if(file_exists($f)){
		unlink($f);
	  }
	  $id = $request->getParsedBody()['id'];
	  $model->deleteProduct($id);
	  return $this->view->renderingAPI($response, ['code'=>200,'mes'=>"Товар удален {$id}"]);
  }
  
  //------API admin Material------//

	function AddMaterialAPI($request, $response) //Добавить материал
	{
		if (!$this->checkAdmin($request)) {
			return $this->view->error404($response);
		}
		$file = $request->getUploadedFiles()['pictures'];
		$name = $request->getParsedBody()["name"];
		$description = $request->getParsedBody()["description"];
		$nameIMG = hash('ripemd128',$name.$description);
		if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
		{
	  		$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
		}
		$model = new \Model\ListMaterials;
		$AllCategory = $model->createMaterial($name,$description,$nameIMG);
		return $this->view->renderingAPI($response, ['code'=>200,'mes'=>"Материал добавлен"]);
	}
	  
	function UpdateMaterialAPI($request, $response) //Редактировать материал
	{
		if (!$this->checkAdmin($request)) {
			return $this->view->error404($response);
		}
		$nameIMG=null;
		if(isset($request->getUploadedFiles()['pictures']))
		{
			$file = $request->getUploadedFiles()['pictures'];
			$id = $request->getParsedBody()['id'] ?? "123";
			$nameIMG = hash('ripemd128',$file->getFilePath().$id);
			if(!$this->resize_photo($this->IMGproduct,"$nameIMG.jpg",$file->getSize(),$file->getClientMediaType(),$file->getFilePath()))
			{
				$file->moveTo("$this->IMGproduct/$nameIMG.jpg");
			}
			$oldIMG = $request->getParsedBody()['OLDpictures'];
			$f = "$this->IMGmaterial/$oldIMG.jpg";
			if(file_exists($f))
			{
				unlink($f);
			}
		}
		$model = new \Model\ListMaterials;
		$id = $request->getParsedBody()['id'];
		$model->updateMaterial($id,$request->getParsedBody()['name'],$request->getParsedBody()['description'],$nameIMG);
		return $this->view->renderingAPI($response, ['code'=>200,'mes'=>"Материал обновлен {$id}"]);
	}
	  
	function DelMaterialAPI($request, $response) //Удалить материал
	{
		if (!$this->checkAdmin($request)) {
			return $this->view->error404($response);
		}
		$model = new \Model\ListMaterials;
		$oldIMG = $model->getInfoMaterialID($request->getParsedBody()['id'])["img"];
		$f = "$this->IMGmaterial/$oldIMG.jpg";
    	if(file_exists($f)){
			unlink($f);
		}
		$model->deleteMaterial($request->getParsedBody()['id']);
		return $this->view->renderingAPI($response, ['code'=>200,'mes'=>"Материал {$id} удален"]);
	}
}


 ?>
