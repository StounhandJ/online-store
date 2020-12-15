<?php
/* Smarty version 3.1.36, created on 2020-12-15 19:57:02
  from '/home/c/cn61693/public_html/Template/Admin/main-mebel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd8eade0d7ac0_97859199',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '64466b67fd0a774e284d416d53a67237dffed77c' => 
    array (
      0 => '/home/c/cn61693/public_html/Template/Admin/main-mebel.tpl',
      1 => 1608050949,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd8eade0d7ac0_97859199 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet"/>
		<title>Главная</title>
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
">Главная →</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/add">Добавить</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/change">Изменить</a></li>
					<li><a href="/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/delete">Удалить</a></li>
				</ul>
			</nav>
		</div>
		<div class="all">
			<div class="main">
				<h2>Редактировать</h2>
				<form action="#" id ="change_info" method="post">
					<div class="input">
						<label for="name" >Номер телефона</label>
						<input type="text" name="name" id="telephone" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['telephone'];?>
" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Почта</label>
						<input type="text" name="name" id="email" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['email'];?>
" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Соц. сеть</label>
						<select name="list1" id="socialNetwork">
 							<option>Выберите из списка</option>
 							<option value="vk">ВК</option>
 							<option value="instagram">Инстаграм</option>
 						</select>
					</div>
					<div class="input">
						<label for="name">Новая ссылка</label>
						<input type="text" name="name" id="NEWsocialNetwork" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Часы работы</label>
						<input type="text" name="name" id="officeHours" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['officeHours'];?>
" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Description основной</label>
						<input type="text" name="name" id="descriptionMain" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['descriptionMain'];?>
" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Description товаров</label>
						<input type="text" name="name" id="descriptionProduct" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['descriptionProduct'];?>
" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Description материалов</label>
						<input type="text" name="name" id="descriptionMaterial" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['descriptionMaterial'];?>
" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Description монтаж</label>
						<input type="text" name="name" id="descriptionMontage" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['descriptionMontage'];?>
" tabindex="1" />
					</div>
					<div class="button">
						<input type="submit" value="СОХРАНИТЬ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html><?php }
}
