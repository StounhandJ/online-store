<?php
/* Smarty version 3.1.36, created on 2020-12-15 19:56:03
  from '/home/c/cn61693/public_html/Template/Admin/Delete-mebel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd8eaa350cdd9_27306837',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11a6c8f9288df1bc8272dee21db6cffa53382d80' => 
    array (
      0 => '/home/c/cn61693/public_html/Template/Admin/Delete-mebel.tpl',
      1 => 1608051234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd8eaa350cdd9_27306837 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Удалить</title>
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
/add">Добавить</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/change">Изменить</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/delete">Удалить →</a></li>
				</ul>
			</nav>
		</div>
		<div class="all">
			<div class="main">
				<h2>УДАЛИТЬ ТОВАР</h2>
				<form action="#" method="post" id="delete_product">
					<div class="input">
						<label for="name">Удалить товар</label>
							<select name="list1" id="product">
 								<option>Выберите из списка</option>
 							
 								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AllProducts']->value, 'var');
$_smarty_tpl->tpl_vars['var']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->do_else = false;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['var']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['var']->value['name'];?>
</option>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							
 							</select>
					</div>

					<div class="button">
						<input type="submit" value="УДАЛИТЬ ТОВАР" />
					</div>
				</form>
				<form action="#" method="post" id="delete_material">
					<h2>УДАЛИТЬ МАТЕРИАЛ</h2>
					<div class="input">
						<label for="name">Удалить материал</label>
						<select name="list1" id="material">
 							<option>Выберите из списка</option>
 							
 							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AllMaterials']->value, 'var');
$_smarty_tpl->tpl_vars['var']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->do_else = false;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['var']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['var']->value['name'];?>
</option>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								
 						</select>
					</div>
					<div class="button">
						<input type="submit" value="УДАЛИТЬ МАТЕРИАЛ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html><?php }
}
