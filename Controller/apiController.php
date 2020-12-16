<?php
namespace Controller;



class apiController extends AController
{

  function __construct()
  {
  	
  }
  
  function __call($name, $args)
  {
  	$this->before($args[0], $args[1]);
  	return $this->{$name}();
  }
  

	protected function СartPush()  //Отправляет заказ на почту
	{
	    if (!isset($this->COOKIE["cart"])) 
	    {
	      $out = ['code'=>400,'mes'=>'Корзина пуста'];
	      return $this->view->renderingAPI($out);
	    }
	    $text ="";
	    $text.=$this->POST["name"].";\n".$this->POST["phone"].";\n".$this->POST["email"]."\n\n";
	    $cart = json_decode($this->COOKIE["cart"],true) ?? [];
	    foreach($cart as $key=>$val)
	    {
	    	$product = $this->GoodsM->getInfoProductID($key);
	    	$name = $product["name"];
	    	$corpusMaterial = $this->MaterialsM->getInfoMaterialID($val["corpusMaterial"])["name"]??"Не указано";
	    	$facadeMaterial = $this->MaterialsM->getInfoMaterialID($val["facadeMaterial"])["name"]??"Не указано";
	    	$corpusColor = $val["corpusColor"]??"Не указано";
	    	$facadeColor = $val["facadeColor"]??"Не указано";
	    	if($product!=NULL)
	    	{
	    		$totalPrice+= (int)str_replace([" ","р."],"",$product["price"]);
	    		$text.=($product['facade']=="1")?"$name - материал корпуса $corpusMaterial и цвет $corpusColor, материал фасада $facadeMaterial и цвет $facadeColor;\n":"$name - материал корпуса $corpusMaterial и цвет $corpusColor;\n";
	    	}
	    }
	    $price = number_format($totalPrice, 0, ',', ' ') . " р.";
	    $text.="Итоговая цена: $price \n\nАдресс: ".$this->POST["address"].";\nКомментарий к заказу: ".$this->POST["comment"];
	    mail("roman.m2003@yandex.ru","Заказ",$text);
	    unset($this->COOKIE['cart']);
    	setcookie('cart', null, -1, '/');
    	$out = ['code'=>200,'mes'=>'Заказ успешно отправлен'];
    	return $this->view->renderingAPI($out);
	}

	protected function AddСart()  //Добавляет товар в корзину по id//
	{
		
		$productID = $this->POST["productID"];
	    if (!isset($productID)) {
	      $out = ['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации'];
	    }
	    else
	    {
		    $cart = json_decode($this->COOKIE["cart"],true) ?? [];
		    if (!array_key_exists($productID,$cart)) {
		      $cart[$productID] = [];
		      setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
		    }
		    $out = ['code'=>200,'mes'=>'Товар добавлен в корзину'];
	    }
	    return $this->view->renderingAPI($out);
	}
  
    protected function AddСartColor()  //Добавляет товару цвет в корзине//
	{
	    $cart = json_decode($this->COOKIE["cart"],true) ?? [];
	    $facadePost = $this->POST['facade'];
	    $productID = $this->POST['productID'];
	    $color = $this->POST['color'];
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
	    return $this->view->renderingAPI($out);
	}
  
    protected function AddСartMaterial()  //Добавляет товару материал в корзине//
	{
	    $cart = json_decode($this->COOKIE["cart"],true) ?? [];
	    $facadePost = $this->POST['facade'];
	    $productID = $this->POST['productID'];
	    $materialID = $this->POST['materialID'];
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
	    return $this->view->renderingAPI($out);
	}
	
	protected function DelСart()  //Удаляет товар из корзины по id//
	{
		$productID = $this->POST["productID"];
	    if (!isset($productID)) {
	      $out = ['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации'];
	    }
	    else{
		    $cart = json_decode($this->COOKIE["cart"],true) ?? [];
		    if (isset($cart[$productID])) {
		      unset($cart[$productID]);
		      setcookie("cart", json_encode($cart),time()+60*60*24*7,'/');
		    }
		    $out = ['code'=>200,'mes'=>'Товар был удален из корзины'];
	    }
	    return $this->view->renderingAPI($out);
	}

	protected function CategoryGet() //Возвращает имена всех категорий//
	{
	    $AllCategory = $this->GoodsM->getAllCategory() ?? [];
	    $out = [
	      "code"=>200,
	      "mes"=>"ok",
	      "data"=>$AllCategory
	    ];
	    return $this->view->renderingAPI($out);
	}

	protected function ProductInfo() //Возвращает информацию о товаре по ID//
	{
	    $id= $this->GET['id'];
	    if (!isset($id)) {
	      $out=['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации',"items"=>[]];
	      return $this->view->renderingAPI($out);
	    }
	    $InfoProduct = $this->GoodsM->getInfoProductID($id); //сколько товаров вернет из категории
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
	    return $this->view->renderingAPI($out);
	}
  
  
    protected function MaterialInfo() //Возвращает информацию о материале по ID//
	{
	    $id= $this->GET['id'];
	    if (!isset($id)) {
	      $out=['code'=>400,'mes'=>'Указаны не все параметры, обратитесь к документации',"data"=>[]];
	      return $this->view->renderingAPI($out);
	    }
	    $InfoProduct = $this->MaterialsM->getInfoMaterialID($id); //сколько товаров вернет из категории
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
	    return $this->view->renderingAPI($out);
	}


    protected function InfoGet() //Возвращает основную информацию о сайте//
	{
	    $InfoProduct = $this->InformationM->get();
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
	    return $this->view->renderingAPI($out);
	}

}


 ?>
