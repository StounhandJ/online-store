<?php
/* Smarty version 3.1.36, created on 2020-12-15 21:26:15
  from '/home/c/cn61693/public_html/Template/Admin/Add-mebel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd8ffc7a95c84_77101279',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b61cdcd6a892d14f96970eebeae83ed678325b89' => 
    array (
      0 => '/home/c/cn61693/public_html/Template/Admin/Add-mebel.tpl',
      1 => 1608056717,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd8ffc7a95c84_77101279 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Добавить</title>
		<link rel="stylesheet" type="text/css" href="/Template/css/Admin/Admin-main.css">
		<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.5.1.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/Template/js/admin.js"><?php echo '</script'; ?>
>
	</head>
	<body>
		<div class="black-line"></div>
		<div class="nav-panel">
			<div class="admin">ADMIN</div>
			<nav>
				<ul>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">Главная</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/add">Добавить →</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/change">Изменить</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/delete">Удалить</a></li>
				</ul>
			</nav>
		</div>
		<div class="all">
			<div class="main">
				<h2>НОВЫЙ ТОВАР</h2>

				<form action="#" id="new_product" method="post" enctype="multipart/form-data">
					<div class="input">
						<label for="name" >Добавить новую категорию</label>
						<input type="text" name="name" id="new_category" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Категория</label>
						<select name="list1" id="old_category">
 							<option>Выберите из списка</option>
 							
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AllCategory']->value, 'var');
$_smarty_tpl->tpl_vars['var']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->do_else = false;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['var']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['var']->value;?>
</option>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

 						</select>
					</div>
					<div class="input">
						<label for="name">Название товара</label>
						<input type="text" name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Цена</label>
						<input type="text" name="name" id="price" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Описание</label>
						<input type="text" name="name" id="description" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Наличие фасада</label>
						<select name="list1" id="facade">
 							<option>Выберите из списка</option>
 							<option value="1">Да</option>
 							<option value="0">Нет</option>
 						</select>
					</div>
					<div class="input-file">
						<label for="name">Добавить картинку</label>
						<label class="fileUP"><span class="text">выберите файл</span><input type="file" name="pictures" id="pictures" tabindex="1" accept="image/*"/>
						</label>
					</div>
					<div class="button">
						<input type="submit" value="ДОБАВИТЬ" />
					</div>
				</form>
			</div>
			<div class="main">
				<h2>НОВЫЙ МАТЕРИАЛ</h2>
				<form action="#" method="post" id="new_material" enctype="multipart/form-data"> 
					<div class="input">
						<label for="name">Название материала</label>
						<input type="text" name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Описание</label>
						<input type="text" name="description" id="description" value="" tabindex="1" />
					</div>
					<div class="input-file">
						<label for="name">Добавить картинку</label>
						<label class="fileUP"><span class="text">выберите файл</span><input type="file" name="pictures" id="pictures" tabindex="1" accept="image/*"/>
						</label>
					</div>
					<div class="button">
						<input type="submit" value="ДОБАВИТЬ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
<?php }
}
