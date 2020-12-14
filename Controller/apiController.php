<?php
namespace Controller;



class apiController extends AController
{

  function __construct()
  {
  	$this->view = new \Libraries\View();
  }
  

	function СartPush($request, $response, array $args)  //Отправляет заказ на почту
	{
	    if (!isset($request->getCookieParams()["cart"])) 
	    {
	      $out = ['code'=>400,'mes'=>'Корзина пуста'];
	      return $this->view->renderingAPI($response,$out);
	    }
	    
	    $goods = new \Model\ListGoods;
	    $material = new \Model\ListMaterials;
	    $text ="";
	    $text.=$request->getParsedBody()["name"].";\n".$request->getParsedBody()["phone"].";\n".$request->getParsedBody()["email"]."\n\n";
	    $cart = json_decode($request->getCookieParams()["cart"],true) ?? [];
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
	    $text.="Итоговая цена:".$price."\n\n".$request->getParsedBody()["address"].";\n".$request->getParsedBody()["comment"];
	    mail("roman.m2003@yandex.ru","Заказ",$text);
	    unset($request->getCookieParams()['cart']);
    	setcookie('cart', null, -1, '/');
    	$out = ['code'=>200,'mes'=>'Заказ успешно отправлен'];
    	return $this->view->renderingAPI($response,$out);
	}

	function AddСart($request, $response, array $args)  //Добавляет товар в корзину по id//
	{
		$productID = $request->getParsedBody()["productID"];
	    if (!isset($productID)) {
	      $out = ['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации'];
	    }
	    else
	    {
		    $cart = json_decode($request->getCookieParams()["cart"],true) ?? [];
		    if (!array_key_exists($productID,$cart)) {
		      $cart[$productID] = [];
		      setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
		    }
		    $out = ['code'=>200,'mes'=>'Товар добавлен в корзину'];
	    }
	    return $this->view->renderingAPI($response,$out);
	}
  
    function AddСartColor($request, $response, array $args)  //Добавляет товару цвет в корзине//
	{
	    $cart = json_decode($request->getCookieParams()["cart"],true) ?? [];
	    $facadePost = $request->getParsedBody()['facade'];
	    $productID = $request->getParsedBody()['productID'];
	    $color = $request->getParsedBody()['color'];
	    if (!isset($productID) || !isset($facadePost) || !isset($color) || !isset($cart[$productID])) {
	      $out = ['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации'];
	    }
	    else
	    {
		    $facade=($facadePost=="1")? true : false;
		    if($facade){
		    	$cart[$productID]["facadeColor"]=$color;
		    }
		    else
		    {
		    	$cart[$productID]["corpusColor"]=$color;
		    }
		    setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
		    $out = ['code'=>200,'mes'=>'Цвет успешно добавлен'];
	    }
	    return $this->view->renderingAPI($response,$out);
	}
  
     function AddСartMaterial($request, $response, array $args)  //Добавляет товару материал в корзине//
	{
	    $cart = json_decode($request->getCookieParams()["cart"],true) ?? [];
	    $facadePost = $request->getParsedBody()['facade'];
	    $productID = $request->getParsedBody()['productID'];
	    $materialID = $request->getParsedBody()['materialID'];
	    if (!isset($productID) || !isset($facadePost) || !isset($materialID) || !isset($cart[$productID])) {
	      $out = ['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации'];
	    }
	    else
	    {
		    $facade=($facadePost=="1")? true : false;
		    if($facade){
		    	$cart[$productID]["facadeMaterial"]=$materialID;
		    }
		    else
		    {
		    	$cart[$productID]["corpusMaterial"]=$materialID;
		    }
		    setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
		    $out = ['code'=>200,'mes'=>'Материал успешно добавлен'];
	    }
	    return $this->view->renderingAPI($response,$out);
	}
	
	function DelСart($request, $response, array $args)  //Удаляет товар из корзины по id//
	{
		$productID = $request->getParsedBody()["productID"];
	    if (!isset($productID)) {
	      $out = ['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации'];
	    }
	    else{
		    $cart = json_decode($request->getCookieParams()["cart"],true) ?? [];
		    if (isset($cart[$productID])) {
		      unset($cart[$productID]);
		      setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
		    }
		    $out = ['code'=>200,'mes'=>'Товар был удален из корзины'];
	    }
	    return $this->view->renderingAPI($response,$out);
	}

	function CategoryGet($request, $response, array $args) //Возвращает имена всех категорий//
	{
	    $model = new \Model\ListGoods;
	    $AllCategory = $model->getAllCategory() ?? [];
	    $out = [
	      "code"=>200,
	      "mes"=>"ok",
	      "data"=>$AllCategory
	    ];
	    return $this->view->renderingAPI($response,$out);
	}

	function ProductInfo($request, $response, array $args) //Возвращает информацию о товаре по ID//
	{
	    $id= $request->getQueryParams()['id'];
	    if (!isset($id)) {
	      $out=['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации',"items"=>[]];
	      return $this->view->renderingAPI($response,$out);
	    }
	    $model = new \Model\ListGoods;
	    $InfoProduct = $model->getInfoProductID($id); //сколько товаров вернет из категории
	    if (!isset($InfoProduct)) {
	      $out=['code'=>404,'mes'=>'Данный продукт не найден',"data"=>[]];
	    }
	    else{
		    $out = [
		      "code"=>200,
		      "mes"=>"ok",
		      "data"=>$InfoProduct
		    ];
	    }
	    return $this->view->renderingAPI($response,$out);
	}
  
  
    function MaterialInfo($request, $response, array $args) //Возвращает информацию о материале по ID//
	{
	    $id= $request->getQueryParams()['id'];
	    if (!isset($id)) {
	      $out=['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации',"data"=>[]];
	      return $this->view->renderingAPI($response,$out);
	    }
	    $model = new \Model\ListMaterials;
	    $InfoProduct = $model->getInfoMaterialID($id); //сколько товаров вернет из категории
	    if (!isset($InfoProduct)) {
	      $out=['code'=>404,'mes'=>'Данный продукт не найден',"data"=>[]];
	    }
	    else{
	    	$out = [
	      "code"=>200,
	      "mes"=>"ok",
	      "data"=>$InfoProduct
	    ];
	    }
	    return $this->view->renderingAPI($response,$out);
	}


    function InfoGet($request, $response, array $args) //Возвращает основную информацию о сайте//
	{
	    $model = new \Model\InformationSite;
	    $InfoProduct = $model->get();
	    if (!isset($InfoProduct)) {
	      $out=['code'=>404,'mes'=>'Данный продукт не найден',"data"=>[]];
	    }
	    else{
	    	$out = [
	      "code"=>200,
	      "mes"=>"ok",
	      "data"=>$InfoProduct
	    ];
	    }
	    return $this->view->renderingAPI($response,$out);
	}

}


 ?>
