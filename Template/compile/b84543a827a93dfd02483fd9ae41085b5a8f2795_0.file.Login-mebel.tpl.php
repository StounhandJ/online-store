<?php
/* Smarty version 3.1.36, created on 2020-12-16 19:28:51
  from '/home/c/cn61693/public_html/Template/Admin/Login-mebel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fda35c3495114_51642524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b84543a827a93dfd02483fd9ae41085b5a8f2795' => 
    array (
      0 => '/home/c/cn61693/public_html/Template/Admin/Login-mebel.tpl',
      1 => 1608136129,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fda35c3495114_51642524 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet"/>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.5.1.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/Template/js/LoginAdmin.js"><?php echo '</script'; ?>
>
	<meta charset="utf-8">
	<title>Войти</title>
	<link rel="stylesheet" type="text/css" href="/Template/css/Admin/Admin-login.css">
  </head>
  <body>
    <div class="black-line"></div>
    <div class="orange-line"></div>
		<form class="box" action="#">
			<h2>ЛОГИН</h2>
				<input type="text" id="login" placeholder="Введите логин...">
			<h2>ПАРОЛЬ</h2>
				<input type="password" id="password" placeholder="Введите пароль...">
			<p>
				<input type="submit" id="push" value="ВОЙТИ">
			</p>
		</form>
  </body>
</html><?php }
}
