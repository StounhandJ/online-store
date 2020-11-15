<?php
namespace Controller;



class apiController extends AController
{

  function __construct()
  {
  }

  function AddСart()  //Добавляет товар в корзину по id
  {
    if (!isset($_GET["productID"]) || !isset($_GET['url'])) {
      return;
    }
    $cart = json_decode($_COOKIE["cart"]) ?? [];
    if (!in_array($_GET["productID"],$cart)) {
      $cart[] = $_GET["productID"];
      setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
    }
    $url = $_GET['url'];
    header("Location: {$url}");
    echo "err";
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

}


 ?>
