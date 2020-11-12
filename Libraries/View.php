<?php

namespace Libraries;

class View
{

	function __construct(){
    //ignor
		}

    function rendering($name,$data = [])
    {
      require(__DIR__ . "/../Template/{$name}.php");
    }

		function redirect($url)
		{
				header('Location: /'.$url);
		}
}
