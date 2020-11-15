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
		$query = $this->db->request('SELECT `id`,`name`,`price`,`description`,`category`,`img` FROM `goods` WHERE `category`=:category LIMIT :min,:max',$data);
    if($query["code"] != 200)
		{
			return NULL;
		}
		return $query["data"];
  }
  
  function getAllGoods() //Возвращает все товары в алфавитном порядке
  {
	$query = $this->db->request('SELECT * FROM `goods` WHERE 1 ORDER BY `name`');
    if($query["code"] != 200)
		{
			return NULL;
		}
	return $query["data"];
  }

  function getInfoProductID($id) //Возвращает всю информацию о определенном продукте
  {
    $query = $this->db->request('SELECT * FROM `goods` WHERE `id`=:id',[':id'=>$id]);
    if($query["code"] != 200)
    {
      return NULL;
    }
    return $query["data"][0];
  }

  function getInfoProductName($name,$category) //Возвращает всю информацию о определенном продукте
  {
    $query = $this->db->request('SELECT * FROM `goods` WHERE `name`=:name AND `category`=:category',[':name'=>$name,':category'=>$category]);
    if($query["code"] != 200)
    {
      return NULL;
    }
    return $query["data"][0];
  }
  
  function getSumProduct($category)
  {
  	$query = $this->db->request('SELECT COUNT(id) AS "sum" FROM `goods` WHERE `category`=:category',[':category'=>$category]);
  	if($query["code"] != 200)
    {
      return NULL;
    }
    return $query["data"][0]["sum"];
  }

  function updateProduct($id,$name,$price,$description,$category,$facade,$img)
  {
  	$sql = 'UPDATE `goods` SET ';
  	if(isset($name)) {$sql.='`name`=:name,';$data[':name']=$name;}
  	if(isset($price)) {$sql.='`price`=:price,';$data[':price']=$price;}
  	if(isset($description)) {$sql.='`description`=:description,';$data[':description']=$description;}
  	if(isset($category)) {$sql.='`category`=:category,';$data[':category']=$category;}
  	if(isset($facade)) {$sql.='`facade`=:facade,';$data[':facade']=$facade;}
  	if(isset($img)) {$sql.='`img`=:img,';$data[':img']=$img;}
  	$sql = substr($sql,0,-1);
  	$sql.=" WHERE `id`=:id"; $data[':id']=$id;
    $this->db->request($sql,$data);
  }
  
  function createProduct($name,$price,$description,$category,$facade,$img)
  {
  	$data=[
      ':name'=>$name,
      ':price'=>$price,
      ':description'=>$description,
      ':category'=>$category,
      ':facade'=>$facade,
      ':img'=>$img,

    ];
  	 $this->db->request('INSERT INTO `goods`(`name`, `price`, `description`, `category`,`facade` ,`img`) VALUES (:name,:price,:description,:category,:facade,:img)',$data);
  }
  
  function deleteProduct($id)
  {
  	$this->db->request('DELETE FROM `goods` WHERE `id`=:id',[':id'=>$id]);
  }

  function getAllCategory() //Возвращает все категории
  {
		$query = $this->db->request('SELECT DISTINCT `category` FROM `goods` WHERE 1 ORDER BY `category`');
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
