<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet" />
	<meta charset="utf-8">
	<title>Войти</title>
	<link rel="stylesheet" type="text/css" href="/Template/css/Admin/Login-mebel.css">
  </head>
  <body>
    <div class="black-line"></div>
    <div class="orange-line"></div>
		<form class="box" method="post" action="/<?=$data["url"]?>/admin.login">
			<h2>ЛОГИН</h2>
				<input type="text" name="login" placeholder="Введите логин...">
			<h2>ПАРОЛЬ</h2>
				<input type="password" name="password" placeholder="Введите пароль...">
			<p>
				<input type="submit" name="login-button" value="ВОЙТИ">
			</p>
		</form>
  <dody>
<html>
