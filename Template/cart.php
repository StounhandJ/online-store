<?php
require(__DIR__ . DIRECTORY_SEPARATOR."header.php");
?>
	<section id="cart_items">
		<div class="container">
			<h2 style="width:100%;text-align:center;margin-bottom:30px;">КОРЗИНА</h2>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="cart-image-head" style="width:10%;"></td>
							<td class="cart-name-head" style="width:25%;word-warp:break-word;">Товар</td>
							<td class="cart-body-head">Корпус</td>
							<td class="cart-facade-head">Фасад</td>
							<td class="cart-total-head" style="width:15%;">Цена</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						
						<?php $totalPrice = 0;$cart = json_decode($_COOKIE["cart"],true) ?? [];foreach ($data["allProduct"] as $val):?>
						<tr id="<?=$val["id"]?>">
							<td class="cart-image">
								<a href=""><img src="Template/images/product/<?=$val["img"]?>.jpg" alt="" style="height:90px;"></a>
							</td>
							<td class="cart-name">
								<h4><a href=""><?=$val["name"]?></a></h4>
							</td>
							<td class="cart-body">
								<form calss="corpus" action="/materials" method="get">
									<input type="submit" value="Добавить материал" style="border-radius:10px;text-align:center;outline:none;">
									<input type="hidden" value="<?=$val["id"]?>" name="productID" />
									<input type="hidden" value="0" name="facade" />
									<p>Цвет:</p>
								</form>
								<form calss="corpus" action="/test" method="post">
									<input type="hidden" style="width:100px;" class="color" name="color" value="<?=$cart[$val["id"]]["corpusColor"]?>"/>
									<input type="hidden" value="<?=$val["id"]?>"/>
								</form>
							</td>
							<?php if($val["facade"]){?>
								<td class="cart-facade">
										<input type="submit" value="Добавить материал" style="border-radius:10px;text-align:center;outline:none;"><p>Цвет:</p>
									<form calss="facade">
										<input type="hidden" style="width:100px;" class="color" value="<?=$cart[$val["id"]]["facadeColor"]?>"/>
										<input type="hidden" value="<?=$val["id"]?>" />
									</form>
								</td>
							<?php } else{?>
								<td class="cart-facade">
										<p>Недоступно</p>
									</td>
							<?php }?>
							<td class="cart-total">
								<p class="cart_total_price">
								<?php 
								$totalPrice+= (int)str_replace([" ","р."],"",$val["price"]);
								echo $val["price"];?>
								</p>
							</td>
							<td class="cart-delete">
								<a class="cart_quantity_delete" id="<?=$val["id"]?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php endforeach;?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Контактный телефон: 
								<span>
									<div class="input" style="width: 60%;">
										<input type="phone" name="name" id="name" value="" tabindex="1" style="border:0; border-radius:10px;text-align:center;outline:none;width: 100%;"/>
									</div>
								</span>
							</li>
							<li>Почта:  
								<span>
									<div class="input" style="width: 60%;">
										<input type="email" name="name" id="name" value="" tabindex="1" style="border:0; border-radius:10px;text-align:center;outline:none;width: 100%;"/>
									</div>
								</span>
							</li>
							<li>Комментарий к заказу:  
								<span>
									<div class="input" style="width: 60%;">
										<textarea id="name" class="cart-textarea" style="border:0; border-radius:10px;background:white;outline:none;overflow:hidden;"></textarea>
									</div>
								</span>
							</li>
							<li>Итого: <span><?= number_format($totalPrice, 0, ',', ' ') . " р."?></span></li>
						</ul>
							<a class="btn btn-default update" href="">Заказать</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
<?php
require(__DIR__ .DIRECTORY_SEPARATOR. "footer.php");
?>