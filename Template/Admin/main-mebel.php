<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Главная</title>
		<link rel="stylesheet" type="text/css" href="/Template/css/Admin/main-mebel.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="/Template/js/admin.js"></script>
	</head>
	<body>
		<div class="black-line"></div>
		<div class="nav-panel">
			<div class="admin">ADMIN</div>
			<nav>
				<ul>
					<li><a href="/<?=$data['url']?>">Главная →</a></li>
					<li><a href="/<?=$data['url']?>/add">Добавить</a></li>
					<li><a href="/<?=$data['url']?>/change">Изменить</a></li>
					<li><a href="/<?=$data['url']?>/delete">Удалить</a></li>
				</ul>
			</nav>
		</div>
		<div class="all">
			<div class="main">
				<h2>Редактировать</h2>
				<form action="#" id ="change_info" method="post">
					<div class="input">
						<label for="name" >Номер телефона</label>
						<input type="text" name="name" id="telephone" value="<?=$data["info"]["telephone"]?>" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Почта</label>
						<input type="text" name="name" id="email" value="<?=$data["info"]["email"]?>" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Соц. сеть</label>
						<select name="list1" disabled>
 							<option>Выберите из списка</option>
 							<option value="1">Option</option>
 							<option value="2">Textarea</option>
 							<option value="3">Label</option>
 							<option value="4">Fieldset</option>
 							<option value="5">Legend</option>
 						</select>
					</div>
					<div class="input">
						<label for="name">Новая ссылка</label>
						<input type="text" disabled name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Часы работы</label>
						<input type="text" disabled name="name" id="name" value="" tabindex="1" />
					</div>
					<div class="button">
						<input type="submit" value="СОХРАНИТЬ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>