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
    $allPage = ceil($model->getSumMaterial()/$this->materialsPage);
    $page =  $_GET['page']??1;
    $data["info"] = $info->get();
    $data["materials"] = $model->getMaterial($page,$this->materialsPage);
    $data["allPage"] = $allPage;
    $data["page"] =$page;
    $data["name"]="Материалы";
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
    $data["info"] = $info->get();
    $data["name"]="Монтаж";
    $this->view->rendering("montage",$data);
    //Вывод страницы 404
    return;
  }

	function cart(){
		$info = new \Model\InformationSite;
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
