<?php
require(__DIR__ . DIRECTORY_SEPARATOR."header.php");
?>
<section>
		<!--<div style="width:5000px;height:2000px;background-color:black"><span style="color:white;font-size:130px;">СПАСИБО ЗА ОПЛАТУ)</span></div>-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Категории</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<?php foreach ($data['Allcategory'] as $val):?>
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
						<h1 style="font-size:25px;" class="title text-center"><?=$data['category']?></h2>

						<?php foreach ($data['goods'] as $val):
							if (!array_key_exists($val["id"],json_decode($_COOKIE["cart"],true) ?? [])) {
								$button = '<a class="btn btn-default add-to-cart"  id="'.$val["id"].'"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>';
							}
							else{
								$button = '<a class="btn btn-default add-to-cart off">Добавлено!</a>';
							}?>
						<div class="col-sm-4" id="product">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="/Template/images/product/<?=$val["img"]?>.jpg" alt="" />
											<h2><?=$val["price"]?></h2>
											<p><?=$val["name"]?></p>
											<?=$button?>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?=$val["description"]?></h2>
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
				<?php
							$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']."?category=".$data['category']."&page=";
							$col = 0;
							$mas = ($data["page"]!=$data["allPage"]) ? 1:2;
							$mas = ($data["allPage"]<=2) ? $data["page"]-1:$mas;
							$vrem = $data["page"]-$mas;
							$last = $data["page"]-1;
							if($data["page"]!=1){echo "<li><a href='$url$last'>«</a></li>";}
							while($col<$mas+1){
								if($vrem>0){
									if($data["page"]==$vrem){echo "<li class='active'><a href='$url$vrem'>$vrem</a></li>";}
									else{echo "<li><a href='$url$vrem'>$vrem</a></li>";}
									$col+=1;
								}
								$vrem+=1;
							}
							if($data["page"]!=$data["allPage"]){
								$next =($data["page"]!=1)?$data["page"]+1: ($data["allPage"]==2) ? $data["page"]+1:$data["page"]+2;
								echo "<li><a href='$url$next'>$next</a></li>";
								echo "<li><a href='$url$next'>»</a></li>";
							}
				?>
			</ul>
		</div>
	</section>
<?php
require(__DIR__ .DIRECTORY_SEPARATOR. "footer.php");
?>
