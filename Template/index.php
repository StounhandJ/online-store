<?php
require(__DIR__ . DIRECTORY_SEPARATOR."header.php");
?>
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Категории</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<?php foreach ($data['category'] as $val):?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="/?category=<?=$val?>"><?=$val?></a></h4>
									</div>
								</div>
							<?php endforeach;?>

						</div><!--/category-products-->

					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Товары</h2>

						<?php foreach ($data['goods'] as $val):?>

						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="/Template/images/product/<?=$val["img"]?>.jpg" alt="" />
											<h2><?=$val["price"]?></h2>
											<p><?=$val["name"]?></p>
											<a href="api/productAdd?productID=<?=$val['id']?>&url=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?=$val["description"]?></h2>
												<h2><?=$val["price"]?></h2>
												<p><?=$val["name"]?></p>
												<a href="api/productAdd?productID=<?=$val['id']?>&url=<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
											</div>
										</div>
								</div>
							</div>
						</div>

						<?php endforeach;?>

					</div><!--features_items-->

				</div>
			</div>
			<ul class="pagination">
				<li><a href="">«</a></li>
				<li class="active"><a href="">1</a></li>
				<li><a href="">2</a></li>
				<li><a href="">3</a></li>
				<li><a href="">4</a></li>
				<li><a href="">...</a></li>
				<li><a href="">»</a></li>
			</ul>
		</div>
	</section>
<?php
require(__DIR__ .DIRECTORY_SEPARATOR. "footer.php");
?>
