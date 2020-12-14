<?php
namespace Libraries;

class View
{

	function __construct($response=null){
	    $this->response=$response;
		}

    function rendering($name,$data = []) //Старый рендеринг страниц, надо заменить на версию 2
    {
    	require(__DIR__ . "/../Template/{$name}.php");
    }
    
    function rendering2($response,$name,$data = []) //Вторая версия рендеринга с использованием шабонизатора и стандарта PSR-7
    {
    	$response->getBody()->write(require(__DIR__ . "/TemplateEngine.php"));
    	return $this->codeHTML200($response);
    }
    
      function codeHTML200($response) //Возврат кода 200 для html
	{
  	return $response
          ->withHeader('Content-Type', 'text/html')
          ->withStatus(200);
	}
	
	function error404($response) //Рендеринг страницы 404
	{
		$this->rendering("404");
		return $this->codeHTML200($response);
	}

	function redirect($url) //редирект
	{
		header('Location: /'.$url);
	}
	
	function redirect2($response,$url) //редирект с стандартом PSR-7
	{
		return $response->withRedirect("/".$url);
	}
	
	function renderingAPI($response,$text) //Вторая версия рендеринга с использованием шабонизатора и стандарта PSR-7
    {
    	$response->getBody()->write(json_encode($text,JSON_UNESCAPED_UNICODE));
    	return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus(200);
    }
	
	function createPagination($uri,$page,$allPage) //рабочая категория, страница сейчас, общее количество
	{
		$pagination = "";
		$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'].$uri."page=";
		$col = 0;
		$mas = ($page!=$allPage) ? 1:2;
		$mas = ($allPage<=2) ? $page-1:$mas;
		$vrem = $page-$mas;
		$last = $page-1;
		if($page!=1){echo "<li><a href='$url$last'>«</a></li>";}
		while($col<$mas+1){
			if($vrem>0){
				if($page==$vrem){$pagination.= "<li class='active'><a href='$url$vrem'>$vrem</a></li>";}
				else{$pagination.= "<li><a href='$url$vrem'>$vrem</a></li>";}
				$col+=1;
			}
			$vrem+=1;
		}
		if($page!=$allPage){
			$next =($page!=1)?$page+1: ($allPage==2) ? $page+1:$page+2;
			$pagination.= "<li><a href='$url$next'>$next</a></li>";
			$pagination.= "<li><a href='$url$next'>»</a></li>";
		}
		return $pagination;
	}
}
