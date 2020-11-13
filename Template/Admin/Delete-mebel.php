<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
		<title>Удалить</title>
		<link rel="stylesheet" type="text/css" href="/Template/css/Admin/Delete-mebel.css">
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
				<form action="#" method="post">
					<div class="input">
						<label for="name">Удалить товар</label>
						<select name="list1">
 							<option>Выберите из списка</option>
 							<option value="1">Option</option>
 							<option value="2">Textarea</option>
 							<option value="3">Label</option>
 							<option value="4">Fieldset</option>
 							<option value="5">Legend</option>
 						</select>
					</div>

					<div class="button">
						<input type="submit" value="УДАЛИТЬ ТОВАР" />
					</div>
					<h2>УДАЛИТЬ МАТЕРИАЛ</h2>
					<div class="input">
						<label for="name">Удалить материал</label>
						<select name="list1">
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