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
					{foreach $allProduct as $val}
					<tr id="{$val.id}">
						<td class="cart-image">
							<a href=""><img src="Template/images/product/{$val.img}.jpg" alt="" style="height:90px;"></a>
						</td>
						<td class="cart-name">
							<h4><a href="">{$val.name}</a></h4>
						</td>
						<td class="cart-body">
							<form class="corpus">
								{if $val.corpusMaterial}
									<a class="btn btn-default add-material" id="{$val.id}|0" style="border-radius:10px;text-align:center;outline:none;margin-bottom:5px;">Изменить материал</a>
									<p class="p-material-added">Материал: <b>{$val.corpusMaterial}</b></p>
								{else}
									<a class="btn btn-default add-material"  id="{$val.id}|0" style="border-radius:10px;text-align:center;outline:none;margin-bottom:10px;">Добавить материал</a>
								{/if}
							</form>
							<form class="color-button-corpus" style="display:flex;">
								Цвет:
								<input type="hidden" style="width:100px;" class="color" name="color" value="{$val.corpusColor}"/>
								<input type="hidden" value="{$val.id}"/>
							</form>
							
						</td>
						{if $val.facade }
							<td class="cart-facade">
								<form class="facade" action="/materials" method="get">
										{if $val.facadeMaterial}
											<a class="btn btn-default add-material" id="{$val.id}|1" style="border-radius:10px;text-align:center;outline:none;margin-bottom:5px;">Изменить материал</a>
											<p class="p-material-added">Материал: <b>{$val.facadeMaterial}</b></p>
										{else}
											<a class="btn btn-default add-material"  id="{$val.id}|1" style="border-radius:10px;text-align:center;outline:none;margin-bottom:10px;">Добавить материал</a>
										{/if}
								</form>
								<form class="color-button-facade" style="display:flex;">
									Цвет:
									<input type="hidden" style="width:100px;" class="color" value="{$val.facadeColor}"/>
									<input type="hidden" value="{$val.id}" />
								</form>	
								
							</td>
						{else}
							<td class="cart-facade">
									<p>Недоступно</p>
								</td>
						{/if}
						<td class="cart-total">
							<p class="cart_total_price">
							
							{$val.price}
							</p>
						</td>
						<td class="cart-delete">
							<a class="cart_quantity_delete" id="{$val.id}"><i class="fa fa-times" style="cursor:pointer;"></i></a>
						</td>
					</tr>
					{/foreach}
					
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
						<li>ФИО: 
							<span>
								<div class="input" style="width: 80%;">
									<input type="name" id="name" value="" tabindex="1" style="border:0; border-radius:10px;text-align:center;outline:none;width: 100%;"/>
								</div>
							</span>
						</li>
						<li>Контактный телефон: 
							<span>
								<div class="input" style="width: 80%;">
									<input type="phone" id="phone" value="" tabindex="1" style="border:0; border-radius:10px;text-align:center;outline:none;width: 100%;"/>
								</div>
							</span>
						</li>
						<li>Почта:  
							<span>
								<div class="input" style="width: 80%;">
									<input type="email" id="email" value="" tabindex="1" style="border:0; border-radius:10px;text-align:center;outline:none;width: 100%;"/>
								</div>
							</span>
						</li>
						<li>Адрес: 
							<span>
								<div class="input" style="width: 80%;">
									<input type="text" id="address" value="" tabindex="1" style="border:0; border-radius:10px;text-align:center;outline:none;width: 100%;"/>
								</div>
							</span>
						</li>
						<li>Комментарий к заказу:  
							<span>
								<div class="input" style="width: 80%;">
									<textarea id="comment" class="cart-textarea" style="border:0; border-radius:10px;background:white;outline:none;overflow:hidden;"></textarea>
								</div>
							</span>
						</li>
						<li>Итого: <span id="totalPrice">{$totalPrice}</span></li>
					</ul>
					<a class="btn btn-default update" id="cart-form">Заказать</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action-->