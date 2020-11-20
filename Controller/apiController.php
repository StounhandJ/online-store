<?php
namespace Controller;



class apiController extends AController
{

  function __construct()
  {
  }
  

	function СartPush()  //Отправляет заказ на почту
  {
	    if (!isset($_COOKIE["cart"])) {
	      return;
	    }
	    $goods = new \Model\ListGoods;
	    $material = new \Model\ListMaterials;
	    $text ="";
	    $text.=$_POST["name"].";\n".$_POST["phone"].";\n".$_POST["email"]."\n\n";
	    $cart = json_decode($_COOKIE["cart"],true) ?? [];
	    foreach($cart as $key=>$val)
	    {
	    	$product = $goods->getInfoProductID($key);
	    	$name = $product["name"];
	    	$corpusMaterial = $material->getInfoMaterialID($val["corpusMaterial"])["name"]??"Не указано";
	    	$facadeMaterial = $material->getInfoMaterialID($val["facadeMaterial"])["name"]??"Не указано";
	    	$corpusColor = $val["corpusColor"]??"Не указано";
	    	$facadeColor = $val["facadeColor"]??"Не указано";
	    	if($product!=NULL)
	    	{
	    		$totalPrice+= (int)str_replace([" ","р."],"",$product["price"]);
	    		$text.=($product['facade']=="1")?"$name - материал корпуса $corpusMaterial и цвет $corpusColor, материал фасада $facadeMaterial и цвет $facadeColor;\n":"$name - материал корпуса $corpusMaterial и цвет $corpusColor;\n";
	    	}
	    }
	    $price = number_format($totalPrice, 0, ',', ' ') . " р.";
	    $text.="Итоговая цена:".$price."\n\n".$_POST["adress"].";\n".$_POST["comment"];
	    mail("roman.m2003@yandex.ru","Заказ",$text);
	    unset($_COOKIE['cart']);
    	setcookie('cart', null, -1, '/');
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
