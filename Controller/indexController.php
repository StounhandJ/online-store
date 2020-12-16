<?php
namespace Controller;


class indexController extends AController  //Контроллер для основных страниц
{

  function __construct()
  {
    $this->productsPage = 9; //Товаров на одной странице
    $this->materialsPage = 12; //Материалов на одной странице
  }
  
  function __call($name, $args)
  {
  	$this->before($args[0], $args[1]);
  	return $this->{$name}();
  }
  
  protected function index() //Главаня страница
  {
    $infoData = $this->InformationM->get();
    $AllCategory = $this->GoodsM->getAllCategory();
    $category = $this->GET["category"]??$AllCategory[0];
    $allPage = ceil($this->GoodsM->getSumProduct($category)/$this->productsPage);
    $page =  $this->GET["page"]??1;
    $data = [
    	'Allcategory'=>$AllCategory,
    	'category'=>$category,
    	"description"=>(!isset($this->GET['category']))?$infoData["descriptionMain"]:str_replace("{name}",$category,$infoData["descriptionProduct"]),
    	'goods'=>$this->GoodsM->getGoods($category,$page,$this->productsPage),
    	'goods_cart'=>json_decode($this->COOKIE["cart"],true) ?? [],
    	'info'=>$infoData,
    	'name'=>"Товары",
    	'pagination'=>$this->view->createPagination("/?category=".$category."&",$page,$allPage),
    ];
    if (isset($data["goods"])) {
        return $this->view->rendering("index",$data);
    }
    return $this->view->error404();
  }

  protected function materials() //Матеириалы
  {
    $infoData = $this->InformationM->get();
    $allPage = ceil($this->MaterialsM->getSumMaterial()/$this->materialsPage);
    $page =  $this->GET['page']??1;
    $data = [
    	'BuyMaterials'=>isset($this->GET["productID"]),
    	"description"=>$infoData["descriptionMaterial"],
    	"info"=>$infoData,
    	"materials"=>$this->MaterialsM->getMaterial($page,$this->materialsPage),
    	"name"=>"Материалы",
    	'pagination'=>$this->view->createPagination("/materials?",$page,$allPage),
    	];
    if (isset($data["materials"])) {
        return $this->view->rendering("materials",$data);
    }
    return $this->view->error404();
  }
  
  
   protected function montage() //Монтаж
   {
    $data = [
    	"description"=>$infoData["descriptionMontage"],
    	"info"=>$this->InformationM->get(),
    	"name"=>"Монтаж",
    	];
    return $this->view->rendering("montage",$data);
   }

	protected function cart() //Корзина
	{
		$allProduct = [];
		$cart = json_decode($this->COOKIE["cart"],true) ?? [];
		$totalPrice = 0;
		foreach ($cart as $key=>$val) 
		{
			$product = $this->GoodsM->getInfoProductID($key);
			if(isset($product)){
				if($cart[$key]["corpusMaterial"]){$product["corpusMaterial"] = $this->MaterialsM->getInfoMaterialID($cart[$key]["corpusMaterial"])["name"];};
				if($cart[$key]["facadeMaterial"]){$product["facadeMaterial"] = $this->MaterialsM->getInfoMaterialID($cart[$key]["facadeMaterial"])["name"];};
				$totalPrice += (int)str_replace([" ","р."],"",$product["price"]);
				$product["corpusColor"] = $cart[$key]["corpusColor"];
				$product["facadeColor"] = $cart[$key]["facadeColor"];
				$allProduct[]=$product;
			}
		}
		$data = [
			"allProduct"=>$allProduct,
			"info"=>$this->InformationM->get(),
			"name"=>"Корзина",
			"totalPrice"=>number_format($totalPrice, 0, ',', ' ') . " р.",
			
			];
		return $this->view->rendering("cart",$data);
	}

}


 ?>
