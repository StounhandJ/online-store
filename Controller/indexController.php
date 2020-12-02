<?php
namespace Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class indexController extends AController  //Контроллер для основных страниц
{

  function __construct()
  {
    $this->view = new \Libraries\View();
    $this->productsPage = 9; //Товаров на одной странице
    $this->materialsPage = 12; //Материалов на одной странице
  }

  function index() //Главаня страница
  {
    $model = new \Model\ListGoods;
    $info = new \Model\InformationSite;
    $infoData = $info->get();
    $AllCategory = $model->getAllCategory();
    $category = $_GET['category']??$AllCategory[0];
    $allPage = ceil($model->getSumProduct($category)/$this->productsPage);
    $page =  $_GET['page']??1;
    $data["info"] = $info->get();
    $data["goods"] = $model->getGoods($category,$page,$this->productsPage);
    $data["Allcategory"] = $AllCategory;
    $data["category"] = $category;
    $data["allPage"] = $allPage;
    $data["page"] =$page;
    $data["name"]="Товары";
    $data["description"]=(!isset($_GET['category']))?$infoData["descriptionMain"]:str_replace("{name}",$category,$infoData["descriptionProduct"]);
    if (isset($data["goods"])) {
        $this->view->rendering("index",$data);
        //рендеринг странички
        return;
    }
    $this->view->rendering("404");
    //Вывод страницы 404
    return;
  }

  function materials() //Главаня страница
  {
    $model = new \Model\ListMaterials;
    $info = new \Model\InformationSite;
    $infoData = $info->get();
    $allPage = ceil($model->getSumMaterial()/$this->materialsPage);
    $page =  $_GET['page']??1;
    $data["info"] = $infoData;
    $data["materials"] = $model->getMaterial($page,$this->materialsPage);
    $data["allPage"] = $allPage;
    $data["page"] =$page;
    $data["name"]="Материалы";
    $data["description"]=$infoData["descriptionMaterial"];
    if (isset($data["materials"])) {
        $this->view->rendering("materials",$data);
        //рендеринг странички
        return;
    }
    $this->view->rendering("404");
    //Вывод страницы 404
    return;
  }
  
  
    function montage(){ //Монтаж
    $info = new \Model\InformationSite;
    $infoData = $info->get();
    $data["info"] =$infoData;
    $data["name"]="Монтаж";
    $data["description"]=$infoData["descriptionMontage"];
    $this->view->rendering("montage",$data);
    return;
  }

	function cart(){
		$info = new \Model\InformationSite;
		$model = new \Model\ListGoods;
		$cart = json_decode($_COOKIE["cart"]) ?? [];
		$allProduct = [];
		foreach ($cart as $key=>$val) 
		{
			$product = $model->getInfoProductID($key);
			if(isset($product)){$allProduct[]=$product;}
		}
		$data["allProduct"] = $allProduct;
    	$data["info"] = $info->get();
		$data["name"]="Корзина";
		$this->view->rendering("cart",$data);
	}

	function test(){
		$this->view->rendering("test");
	}

  function Product() //Страница товара
  {
    if (!isset($this->args["id"])) {
      $this->view->rendering("404");
      //Вывод страницы 404
      return;
    }
    $model = new \Model\ListGoods;
    $AllCategory = $model->getAllCategory();
    $data["product"] = $model->getInfoProduct($this->args["id"]);
    $data["category"] = $AllCategory;
    if (isset($data)) {
        //$this->view->rendering("product",$data);
        //рендеринг странички
        return;
    }
    $this->view->rendering("404");
    //Вывод страницы 404
    return;
  }

}


 ?>
