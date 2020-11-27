<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Изменить</title>
		<link rel="stylesheet" type="text/css" href="/Template/css/Admin/Admin-main.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="/Template/js/admin.js"></script>
	</head>
	<body>
		<div class="black-line"></div>
		<div class="nav-panel">
			<div class="admin">ADMIN</div>
			<nav>
				<ul>
					<li><a href="/<?=$data['url']?>">Главная</a></li>
					<li><a href="/<?=$data['url']?>/add">Добавить</a></li>
					<li><a href="/<?=$data['url']?>/change">Изменить →</a></li>
					<li><a href="/<?=$data['url']?>/delete">Удалить</a></li>
				</ul>
			</nav>
		</div>
		<div class="all">
			<div class="main">
				<h2>ИЗМЕНИТЬ ТОВАР</h2>
				<form action="#" method="post" id="change_product" enctype="multipart/form-data">
					<div class="input">
						<label for="name" id >Товар</label>
						<select name="list1" id="product">
							<option>Выберите из списка</option>
							
 							<?php foreach ($data["AllProducts"] as $var): ?>
								<option value="<?=$var['id']?>"><?=$var['name']?></option>
							<?php endforeach; ?>

 						</select>
					</div>
					<div class="input">
						<label for="name">Изменить категорию</label>
						<select name="list1" id="category">
 							<option>Выберите из списка</option>
 							
 							<?php foreach ($data["AllCategory"] as $var): ?>
								<option value="<?=$var?>"><?=$var?></option>
							<?php endforeach; ?>
 							
 						</select>
					</div>
					<div class="input">
						<label for="name">Новое название</label>
						<input type="text" name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name" >Новая цена</label>
						<input type="text" name="name" id = "price" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name" >Новое описание</label>
						<input type="text" name="name" id = "description" value="" tabindex="1" />
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
						<label for="name">Изменить картинку</label>
						<label class="fileUP"><span class="text">выберите файл</span><input type="file" name="pictures" id="pictures" tabindex="1" accept="image/*"/>
						</label>
					</div>
					<div class="button">
						<input type="submit" value="ИЗМЕНИТЬ ТОВАР" />
					</div>
				</form>
			</div>
			<div class="main">
				<h2>ИЗМЕНИТЬ МАТЕРИАЛ</h2>
				<form action="#" method="post" id="change_material" enctype="multipart/form-data">
					<div class="input">
						<label for="name">Материал</label>
						<select name="list1" id="material">
 							<option>Выберите из списка</option>
 							
 							<?php foreach ($data["AllMaterials"] as $var): ?>
								<option value="<?=$var['id']?>"><?=$var['name']?></option>
							<?php endforeach; ?>
							
 						</select>
					</div>
					<div class="input">
						<label for="name">Новое название</label>
						<input type="text" name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Новое описание</label>
						<input type="text" name="description" id="description" value="" tabindex="1" />
					</div>
					<div class="input-file">
						<label for="name">Добавить картинку</label>
						<label class="fileUP"><span class="text">выберите файл</span><input type="file" name="pictures" id="pictures" tabindex="1" accept="image/*"/>
						</label>
					</div>
					<div class="button">
						<input type="submit" value="ИЗМЕНИТЬ МАТЕРИАЛ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
