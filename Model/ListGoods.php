<?php
namespace Model;


class ListGoods extends AModel //Работа с продуктами
{

  function __construct()
  {
    $this->connect();
  }

  function getGoods($category,$page=1,$max=10) //Возвращает все товары из определеной кетегории в количестве в зависимости от страницы
  {
		$min = ((($page ?? 1) - 1) * $max);
    $data=[':min'=>$min,':max'=>$max,':category'=>$category];
		$query = $this->db->request('SELECT `id`,`name`,`price`,`description`,`category` FROM `goods` WHERE `category`=:category LIMIT :min,:max',$data);
    if($query["code"] != 200)
		{
			return NULL;
		}
		return $query["data"];
  }

  function getInfoProduct($id) //Возвращает всю информацию о определенном продукте
  {
    $query = $this->db->request('SELECT * FROM `goods` WHERE `id`=:id',[':id'=>$id]);
    if($query["code"] != 200)
    {
      return NULL;
    }
    return $query["data"][0];
  }

  function getAllCategory() //Возвращает все категории
  {
		$query = $this->db->request('SELECT DISTINCT `category` FROM `goods` WHERE 1');
    if($query["code"] != 200)
		{
			return NULL;
		}
    foreach ($query["data"] as $key => $value) {
      $out[$key]=$value["category"];
    }
		return $out;
  }


}


 ?>
