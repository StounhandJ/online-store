<section>
		<!--<div style="width:5000px;height:2000px;background-color:black"><span style="color:white;font-size:130px;">СПАСИБО ЗА ОПЛАТУ)</span></div>-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Категории</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							{foreach $Allcategory as $val}
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="/?category={$val}">{$val}</a></h4>
									</div>
								</div>
							{/foreach}

						</div><!--/category-products-->

					</div>
				</div>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h1 style="font-size:25px;" class="title text-center">{$category}</h1>
							{foreach $goods as $val}
								<div class="col-sm-4" id="product">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
													<img src="/Template/images/product/{$val.img}.jpg" alt="" />
													<h2>{$val.price}</h2>
													<p>{$val.name}</p>
													{if !$val.id|array_key_exists:$goods_cart}
														<a class="btn btn-default add-to-cart"  id="{$val.id}"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
													{else}
														<a class="btn btn-default add-to-cart off">Добавлено!</a>
													{/if}
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<h2>{$val.description}</h2>
													</div>
												</div>
										</div>
									</div>
								</div>
							{/foreach}

			</div><!--features_items-->
		</div>
	</div>
	<ul class="pagination">
		{$pagination}
	</ul>
</div>
</section>