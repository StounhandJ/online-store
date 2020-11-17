<?php
namespace Controller;



class apiController extends AController
{

  function __construct()
  {
  }

  function AddСart()  //Добавляет товар в корзину по id
  {
	    if (!isset($_POST["productID"])) {
	      return;
	    }
	    $cart = json_decode($_COOKIE["cart"],true) ?? [];
	    if (!array_key_exists($_POST["productID"],$cart)) {
	      $cart[$_POST["productID"]] = [];
	      setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
	    }
  }
  
    function AddСartColor()  //Добавляет товару цвет
  {
	    $cart = json_decode($_COOKIE["cart"],true) ?? [];
	    if (!isset($_POST["productID"]) || !isset($_POST['facade']) || !isset($_POST['color']) || !isset($cart[$_POST["productID"]])) {
	      return;
	    }
	    $facade=($_POST["facade"]=="1")? true : false;
	    if($facade){
	    	$cart[$_POST["productID"]]["facadeColor"]=$_POST['color'];
	    }
	    else
	    {
	    	$cart[$_POST["productID"]]["corpusColor"]=$_POST['color'];
	    }
	    setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
  }
  
      function AddСartMaterial()  //Добавляет товару материал
		{
		    $cart = json_decode($_COOKIE["cart"],true) ?? [];
		    if (!isset($_POST["productID"]) || !isset($_POST['facade']) || !isset($_POST['materialID']) || !isset($cart[$_POST["productID"]])) {
		      return;
		    }
		    $facade=($_POST["facade"]=="1")? true : false;
		    if($facade){
		    	$cart[$_POST["productID"]]["facadeMaterial"]=$_POST['materialID'];
		    }
		    else
		    {
		    	$cart[$_POST["productID"]]["corpusMaterial"]=$_POST['materialID'];
		    }
		    setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
		}
	
	function DelСart()  //Удаляет товар из корзины по id
		{
	    if (!isset($_POST["productID"])) {
	      return;
	    }
	    $cart = json_decode($_COOKIE["cart"],true) ?? [];
	    if (isset($cart[$_POST["productID"]])) {
	      unset($cart[$_POST["productID"]]);
	      setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
	    }
	}

  function CategoryGet()
  {
    $model = new \Model\TimeTable;
    $AllCategory = $model->getAllCategory() ?? [];
    $out = [
      "code"=>200,
      "mes"=>"ok",
      "data"=>$AllProduct
    ];
    echo json_encode($out,JSON_UNESCAPED_UNICODE);
  }

  function ProductGet()
  {
    $category = $_GET['category'];
    if (!isset($category)) {
      $out=['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации',"items"=>[]];
      echo json_encode($out,JSON_UNESCAPED_UNICODE);
      return;
    }
    $model = new \Model\TimeTable;
    $AllProduct = $model->getGoods($category,1,100) ?? []; //сколько товаров вернет из категории
    if (!isset($AllProduct)) {
      $out=['code'=>404,'mes'=>'Данная категория не найдена или пуста',"items"=>[]];
      echo json_encode($out,JSON_UNESCAPED_UNICODE);
      return;
    }
    $out = [
      "code"=>200,
      "mes"=>"ok",
      "data"=>$AllProduct
    ];
    echo json_encode($out,JSON_UNESCAPED_UNICODE);
  }

  function ProductInfo()
  {
    $id= $_GET['id'];
    if (!isset($id)) {
      $out=['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации',"items"=>[]];
      echo json_encode($out,JSON_UNESCAPED_UNICODE);
      return;
    }
    $model = new \Model\ListGoods;
    $InfoProduct = $model->getInfoProductID($id); //сколько товаров вернет из категории
    if (!isset($InfoProduct)) {
      $out=['code'=>404,'mes'=>'Данный продукт не найден',"items"=>[]];
      echo json_encode($out,JSON_UNESCAPED_UNICODE);
      return;
    }
    $out = [
      "code"=>200,
      "mes"=>"ok",
      "data"=>$InfoProduct
    ];
    echo json_encode($out,JSON_UNESCAPED_UNICODE);
  }
  
    function MaterialInfo()
  {
    $id= $_GET['id'];
    if (!isset($id)) {
      $out=['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации',"items"=>[]];
      echo json_encode($out,JSON_UNESCAPED_UNICODE);
      return;
    }
    $model = new \Model\ListMaterials;
    $InfoProduct = $model->getInfoMaterialID($id); //сколько товаров вернет из категории
    if (!isset($InfoProduct)) {
      $out=['code'=>404,'mes'=>'Данный продукт не найден',"items"=>[]];
      echo json_encode($out,JSON_UNESCAPED_UNICODE);
      return;
    }
    $out = [
      "code"=>200,
      "mes"=>"ok",
      "data"=>$InfoProduct
    ];
    echo json_encode($out,JSON_UNESCAPED_UNICODE);
  }

    function InfoGet()
  {
    $model = new \Model\InformationSite;
    $InfoProduct = $model->get();
    if (!isset($InfoProduct)) {
      $out=['code'=>404,'mes'=>'Данный продукт не найден',"items"=>[]];
      echo json_encode($out,JSON_UNESCAPED_UNICODE);
      return;
    }
    $out = [
      "code"=>200,
      "mes"=>"ok",
      "data"=>$InfoProduct
    ];
    echo json_encode($out,JSON_UNESCAPED_UNICODE);
  }

}


 ?>
