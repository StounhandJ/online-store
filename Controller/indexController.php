<?php
namespace Controller;


class indexController extends AController  //Контроллер для основных страниц
{

  function __construct()
  {
    $this->view = new \Libraries\View();
    $this->productsPage = 9; //Товаров на одной странице
    $this->materialsPage = 12; //Материалов на одной странице
  }
  
  function index($request, $response, array $args) //Главаня страница
  {
    $model = new \Model\ListGoods;
    $info = new \Model\InformationSite;
    $infoData = $info->get();
    $AllCategory = $model->getAllCategory();
    $category = $request->getQueryParams()["category"]??$AllCategory[0];
    $allPage = ceil($model->getSumProduct($category)/$this->productsPage);
    $page =  $request->getQueryParams()["page"]??1;
    $data = [
    	'Allcategory'=>$AllCategory,
    	'category'=>$category,
    	"description"=>(!isset($_GET['category']))?$infoData["descriptionMain"]:str_replace("{name}",$category,$infoData["descriptionProduct"]),
    	'goods'=>$model->getGoods($category,$page,$this->productsPage),
    	'goods_cart'=>json_decode($request->getCookieParams()["cart"],true) ?? [],
    	'info'=>$info->get(),
    	'name'=>"Товары",
    	'pagination'=>$this->view->createPagination("/?category=".$category."&",$page,$allPage),
    ];
    
    if (isset($data["goods"])) {
        return $this->view->rendering2($response,"index",$data);
    }
    return $this->view->error404($response);
  }

  function materials($request, $response, array $args) //Главаня страница
  {
  	$this->addResponse($response);
    $model = new \Model\ListMaterials;
    $info = new \Model\InformationSite;
    $infoData = $info->get();
    $allPage = ceil($model->getSumMaterial()/$this->materialsPage);
    $page =  $request->getQueryParams()['page']??1;
    $data = [
    	'BuyMaterials'=>isset( $request->getQueryParams()["productID"]),
    	"description"=>$infoData["descriptionMaterial"],
    	"info"=>$infoData,
    	"materials"=>$model->getMaterial($page,$this->materialsPage),
    	"name"=>"Материалы",
    	'pagination'=>$this->view->createPagination("/materials?",$page,$allPage),
    	
    	];
    if (isset($data["materials"])) {
        return $this->view->rendering2($response,"materials",$data);
    }
    return $this->view->error404($response);
  }
  
  
    function montage($request, $response, array $args){ //Монтаж
    $this->addResponse($response);
    
    $info = new \Model\InformationSite;
    $infoData = $info->get();
    $data = [
    	"description"=>$infoData["descriptionMontage"],
    	"info"=>$infoData,
    	"name"=>"Монтаж",
    	];
    return $this->view->rendering2($response,"montage",$data);
  }

	function cart($request, $response, array $args){
		$this->addResponse($response);
		$info = new \Model\InformationSite;
		$model = new \Model\ListGoods;
		$modelMat = new \Model\ListMaterials;
		$cart = json_decode($_COOKIE["cart"]) ?? [];
		$allProduct = [];
		$cart = json_decode($_COOKIE["cart"],true) ?? [];
		$totalPrice = 0;
		foreach ($cart as $key=>$val) 
		{
			$product = $model->getInfoProductID($key);
			if(isset($product)){
				if($cart[$key]["corpusMaterial"]){$product["corpusMaterial"] = $modelMat->getInfoMaterialID($cart[$key]["corpusMaterial"])["name"];};
				if($cart[$key]["facadeMaterial"]){$product["facadeMaterial"] = $modelMat->getInfoMaterialID($cart[$key]["facadeMaterial"])["name"];};
				$totalPrice += (int)str_replace([" ","р."],"",$product["price"]);
				$product["corpusColor"] = $cart[$key]["corpusColor"];
				$product["facadeColor"] = $cart[$key]["facadeColor"];
				$allProduct[]=$product;
			}
		}
		$data["allProduct"] = $allProduct;
    	$data["info"] = $info->get();
		$data["name"]="Корзина";
		$data["totalPrice"]=number_format($totalPrice, 0, ',', ' ') . " р.";
		return $this->view->rendering2($response,"cart",$data);
	}

  function Product() //Страница товара
  {
  	$this->addResponse($response);
  	
    if (!isset($this->args["id"])) {
      $this->view->rendering("404");
      //Вывод страницы 404
      return $this->codeHTML404();
    }
    $model = new \Model\ListGoods;
    $AllCategory = $model->getAllCategory();
    $data["product"] = $model->getInfoProduct($this->args["id"]);
    $data["category"] = $AllCategory;
    if (isset($data)) {
        //$this->view->rendering("product",$data);
        //рендеринг странички
        return $this->codeHTML200();
    }
    $this->view->rendering("404");
    //Вывод страницы 404
    return $this->codeHTML404();
  }

}


 ?>
