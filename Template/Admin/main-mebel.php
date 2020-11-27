<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Главная</title>
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
						<input type="text" name="name" id="officeHours" value="<?=$data["info"]["officeHours"]?>" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Description товаров</label>
						<input type="text" name="name" id="descriptionProduct" value="<?=$data["info"]["descriptionProduct"]?>" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Description материалов</label>
						<input type="text" name="name" id="descriptionMaterial" value="<?=$data["info"]["descriptionMaterial"]?>" tabindex="1" />
					</div>
					<div class="input">
						<label for="name">Description монтаж</label>
						<input type="text" name="name" id="descriptionMontage" value="<?=$data["info"]["descriptionMontage"]?>" tabindex="1" />
					</div>
					<div class="button">
						<input type="submit" value="СОХРАНИТЬ" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>