<?php
namespace Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class indexController extends AController  //Контроллер для основных страниц
{

  function __construct()
  {
    $this->view = new \Libraries\View();
  }

  function index() //Главаня страница
  {
    $model = new \Model\ListGoods;
    $info = new \Model\InformationSite;
    $max = 9;
    $AllCategory = $model->getAllCategory();
    $category = $_GET['category']??$AllCategory[0];
    $allPage = ceil($model->getSumProduct($category)/$max);
    $page =  $_GET['page']??1;
    $data["info"] = $info->get();
    $data["goods"] = $model->getGoods($category,$page,$max);
    $data["category"] = $AllCategory;
    $data["allPage"] = $allPage;
    $data["page"] =$page;
    if (isset($data["goods"])) {
        $this->view->rendering("index",$data);
        //рендеринг странички
        return;
    }
    $this->view->rendering("404");
    //Вывод страницы 404
    return;
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
