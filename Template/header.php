
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Лучшая мебель СНГ - <?=$data["name"]?></title>
    <link href="Template/css/bootstrap.min.css" rel="stylesheet">
    <link href="Template/css/font-awesome.min.css" rel="stylesheet">
    <link href="Template/css/prettyPhoto.css" rel="stylesheet">
    <link href="Template/css/price-range.css" rel="stylesheet">
    <link href="Template/css/animate.css" rel="stylesheet">
	<link href="Template/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]><script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="Template/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="Template/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="Template/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="Template/images/ico/apple-touch-icon-57-precomposed.png">
	<link href="Template/css/main.css" rel="stylesheet">
    
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone" style="margin-right:5px;"></i><?=$data['info']['telephone']?></a></li>
								<li><a href="#"><i class="fa fa-envelope" style="margin-right:5px;"></i><?=$data['info']['email']?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-vk" target="_blank" title="ВКонтакте"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" target="_blank" title="Инстаграм"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href=""><img src="Template/images/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Корзина</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<?php 
									if($data["name"]=="Товары"){echo '<li><a href="/" class="active">Товары</a></li>';}
									else{echo '<li><a href="/">Товары</a></li>';}
									if($data["name"]=="Материалы"){echo '<li><a href="/materials" class="active">Материалы</a></li>';}
									else{echo '<li><a href="/materials">Материалы</a></li>';}
								?>
								<li><a href="#">Монтаж</a></li>
								<li><a href="#">Отзывы</a></li>
								<li><a href="#">Контакты</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
