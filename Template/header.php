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
    <link rel="shortcut icon" href="images/favicon.ico">
	<link href="Template/css/main.css" rel="stylesheet">
	
	<script src="Template/js/jquery.js"></script>
	<script src="Template/js/bootstrap.min.js"></script>
	<script src="Template/js/jquery.scrollUp.min.js"></script>
	<script src="Template/js/price-range.js"></script>
	
    <script src="Template/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/Template/colorpicker/js/evol-colorpicker.min.js"type="text/javascript"charset="utf-8"> ></script>
	<link href="/Template/colorpicker/css/evol-colorpicker.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
	<script src="Template/js/cart.js"></script>
    
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
								<li><a href="<?=$data["info"]["vk"]?>"><i class="fa fa-vk" target="_blank" title="ВКонтакте"></i></a></li>
								<li><a href="<?=$data["info"]["instagram"]?>"><i class="fa fa-instagram" target="_blank" title="Инстаграм"></i></a></li>
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
							<a href="/"><img src="Template/images/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="/cart"><i class="fa fa-shopping-cart"></i> Корзина</a></li>
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
									$out = "";
									$out.= '<li><a href="/"'.(($data["name"]=="Товары")?'class="active"':'').'>Товары</a></li>';
									$out.= '<li><a href="/materials"'.(($data["name"]=="Материалы")?'class="active"':'').'>Материалы</a></li>';
									$out.= '<li><a href="/montage"'.(($data["name"]=="Монтаж")?'class="active"':'').'>Монтаж</a></li>';
									echo $out;
								?>
								<li><a href="#">Контакты</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
