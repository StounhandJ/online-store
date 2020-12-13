<?php
require __DIR__ . '/smarty/Smarty.class.php';
$smarty = new Smarty;
$smarty->template_dir=__DIR__."/../Template";
$smarty->compile_dir=__DIR__."/../Template/compile";
foreach($data as $key=>$value){
	$smarty->assign($key, $value);
}
$out = "";
$out .= $smarty->fetch('header.tpl');
$out .= $smarty->fetch($name.'.tpl');
$out .= $smarty->fetch('footer.tpl');
return $out;