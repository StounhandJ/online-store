<!DOCTYPE html>
<html lang="en">
<head>
  	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(69671746, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/69671746" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
  	<meta name="yandex-verification" content="0efaaa001720d531" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$data['description']?>">
    <meta name="Keywords" content="мебель кухни на заказ Москва доставка">
    <meta property="og:title" content="Лучшая мебель СНГ - <?=$data["name"]?>">
    <meta property="og:description" content="<?=$data['description']?>">
    <meta property="og:site_name" content="Лучшая мебель СНГ">
    <meta property="og:image" content="/Template/images/logoURL.png">
    <link rel="image_src" href="/Template/images/logoURL.png" />
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://cn61693.tmweb.ru/">
    <title>Лучшая мебель СНГ - <?=$data["name"]?></title>
    <link defer href="Template/css/bootstrap.min.css" rel="stylesheet">
    <link defer href="Template/css/font-awesome.min.css" rel="stylesheet">
    <link href="Template/css/animate.css" rel="stylesheet">
    <link href="Template/css/price-range.css" rel="stylesheet">
	<link defer rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="Template/images/favicon.png" type="image/png">
	<link href="Template/css/main.css" rel="stylesheet">
	
	<script src="Template/js/jquery.js"></script>
	<script src="Template/js/bootstrap.min.js"></script>
	<script src="Template/js/jquery.scrollUp.min.js"></script>
	<script src="Template/js/price-range.js"></script>
	
    <script defer src="Template/js/main.js"></script>
    <script defer src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
	<script defer src="/Template/colorpicker/js/evol-colorpicker.min.js"type="text/javascript"charset="utf-8"> ></script>
	<link defer href="/Template/colorpicker/css/evol-colorpicker.min.css" rel="stylesheet" type="text/css">
	<link defer rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
	<script defer src="Template/js/cart.js"></script>
    
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
					<div class="col-sm-4" style="padding-left:15px;">
						<div class="logo pull-left">
							<a href="/"><img src="Template/images/mebel-logo.png" alt="Логотип" style="width:80px;height:105px;"/></a>
							<a href="/" style="color:black;font-size:20px;padding-left:15px;">Zebra Mebel</a>
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
