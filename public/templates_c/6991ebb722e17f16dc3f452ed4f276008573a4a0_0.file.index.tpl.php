<?php
/* Smarty version 3.1.36, created on 2020-12-13 18:51:23
  from '/home/c/cn61693/public_html/Libraries/templates1/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd6387bac4c60_17950619',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6991ebb722e17f16dc3f452ed4f276008573a4a0' => 
    array (
      0 => '/home/c/cn61693/public_html/Libraries/templates1/index.tpl',
      1 => 1607855889,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd6387bac4c60_17950619 (Smarty_Internal_Template $_smarty_tpl) {
?><section>
		<!--<div style="width:5000px;height:2000px;background-color:black"><span style="color:white;font-size:130px;">СПАСИБО ЗА ОПЛАТУ)</span></div>-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Категории</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['Allcategory']->value, 'val');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="/?category=<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</a></h4>
									</div>
								</div>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

						</div><!--/category-products-->

					</div>
				</div>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h1 style="font-size:25px;" class="title text-center"><?php echo $_smarty_tpl->tpl_vars['category']->value;?>
</h1>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['goods']->value, 'val');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
								<div class="col-sm-4" id="product">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
													<img src="/Template/images/product/<?php echo $_smarty_tpl->tpl_vars['val']->value['img'];?>
.jpg" alt="" />
													<h2><?php echo $_smarty_tpl->tpl_vars['val']->value['price'];?>
</h2>
													<p><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</p>
													<?php if (!array_key_exists($_smarty_tpl->tpl_vars['val']->value['id'],$_smarty_tpl->tpl_vars['goods_cart']->value)) {?>
														<a class="btn btn-default add-to-cart"  id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
													<?php } else { ?>
														<a class="btn btn-default add-to-cart off">Добавлено!</a>
													<?php }?>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<h2><?php echo $_smarty_tpl->tpl_vars['val']->value['description'];?>
</h2>
													</div>
												</div>
										</div>
									</div>
								</div>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

			</div><!--features_items-->
		</div>
	</div>
	<ul class="pagination">
		<?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

	</ul>
</div>
</section><?php }
}
