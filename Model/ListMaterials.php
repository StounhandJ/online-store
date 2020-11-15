<?php
namespace Model;


class ListMaterials extends AModel //Работа с материалами
{

  function __construct()
  {
    $this->connect();
  }

  function getMaterial($page=1,$max=10) //Возвращает все материалы в количестве в зависимости от страницы
  {
	$min = ((($page ?? 1) - 1) * $max);
    $data=[':min'=>$min,':max'=>$max];
	$query = $this->db->request('SELECT * FROM `materials` WHERE 1 LIMIT :min,:max',$data);
    if($query["code"] != 200)
	{
		return NULL;
	}
	return $query["data"];
  }
  
    function getAllMaterial() //Возвращает все материалы в алфавитном порядке
  {
	$query = $this->db->request('SELECT * FROM `materials` WHERE 1 ORDER BY `name`');
    if($query["code"] != 200)
		{
			return NULL;
		}
	return $query["data"];
  }
  
  function getInfoMaterialID($id) //Возвращает материал по ID
  {
	$query = $this->db->request('SELECT * FROM `materials` WHERE `id`=:id',[":id"=>$id]);
    if($query["code"] != 200)
	{
		return NULL;
	}
	return $query["data"][0];
  }
  
  function getSumMaterial()
  {
  	$query = $this->db->request('SELECT COUNT(id) AS "sum" FROM `materials` WHERE 1');
  	if($query["code"] != 200)
    {
      return NULL;
    }
    return $query["data"][0]["sum"];
  }
  
  function createMaterial($name,$description,$img) //Создает новые материал
  {
  	$data=[
      ':name'=>$name,
      ':description'=>$description,
      ':img'=>$img,
    ];
  	 $this->db->request('INSERT INTO `materials`(`name`, `description`, `img`) VALUES (:name,:description,:img)',$data);
  }
  
  function updateMaterial($id,$name="",$description="",$img="")  //Обновляет информацию о продукте по ID
  {
  	$sql = 'UPDATE `materials` SET ';
  	if(isset($name)) {$sql.='`name`=:name,';$data[':name']=$name;}
  	if(isset($description)) {$sql.='`description`=:description,';$data[':description']=$description;}
  	if(isset($img)) {$sql.='`img`=:img,';$data[':img']=$img;}
  	$sql = substr($sql,0,-1);
  	$sql.=" WHERE `id`=:id"; $data[':id']=$id;
    $this->db->request($sql,$data);
  }
  
  function deleteMaterial($id)
  {
  	 $this->db->request('DELETE FROM `materials` WHERE `id`=:id',[':id'=>$id]);
  }

}


 ?>
