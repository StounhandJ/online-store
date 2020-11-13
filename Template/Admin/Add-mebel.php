<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Добавить</title>
		<link rel="stylesheet" type="text/css" href="/Template/css/Admin/Add-mebel.css">
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
					<li><a href="/<?=$data['url']?>/add">Добавить →</a></li>
					<li><a href="/<?=$data['url']?>/change">Изменить</a></li>
					<li><a href="/<?=$data['url']?>/delete">Удалить</a></li>
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
 							
							<?php foreach ($data["AllCategory"] as $var): ?>
								<option value="<?=$var?>"><?=$var?></option>
							<?php endforeach; ?>

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
					<div class="input-file">
						<label for="name">Добавить картинку</label>
						<label class="fileUP">
							выберите файл
						<input type="file" name="pictures" id="pictures" tabindex="1"/>
						</label>
					</div>
					<div class="button">
						<input type="submit" value="ДОБАВИТЬ" />
					</div>
				</form>
			</div>
			<div class="main">
				<h2>НОВЫЙ МАТЕРИАЛ</h2>
				<form action="#" method="post">
					<div class="input">
						<label for="name">Название материала</label>
						<input type="text" name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Цена</label>
						<input type="text" name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Описание</label>
						<input type="text" name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input-file">
						<label for="name">Добавить картинку</label>
						<input type="file" name="file" id="file" tabindex="1" accept="image/*"/>
						<label for="file">выберите файл</label>
					</div>
					<div class="button">
						<input type="submit" value="ДОБАВИТЬ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
