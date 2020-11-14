<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Удалить</title>
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
					<li><a href="/<?=$data['url']?>/change">Изменить</a></li>
					<li><a href="/<?=$data['url']?>/delete">Удалить →</a></li>
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
 							
 								<?php foreach ($data["AllProducts"] as $var): ?>
									<option value="<?=$var['id']?>"><?=$var['name']?></option>
								<?php endforeach; ?>
							
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
 							<option value="1">Option</option>
 							<option value="2">Textarea</option>
 							<option value="3">Label</option>
 							<option value="4">Fieldset</option>
 							<option value="5">Legend</option>
 						</select>
					</div>
					<div class="button">
						<input type="submit" value="УДАЛИТЬ МАТЕРИАЛ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>