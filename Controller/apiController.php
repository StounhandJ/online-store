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

}


 ?>
