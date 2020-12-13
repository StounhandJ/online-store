<?php
/* Smarty version 3.1.36, created on 2020-12-13 23:48:31
  from '/home/c/cn61693/public_html/Template/cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd67e1f056871_41266873',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fcf1ee43a8a498d475094e3d870785b08fc9667e' => 
    array (
      0 => '/home/c/cn61693/public_html/Template/cart.tpl',
      1 => 1607892471,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd67e1f056871_41266873 (Smarty_Internal_Template $_smarty_tpl) {
?><section id="cart_items">
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
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allProduct']->value, 'val');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
					<tr id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">
						<td class="cart-image">
							<a href=""><img src="Template/images/product/<?php echo $_smarty_tpl->tpl_vars['val']->value['img'];?>
.jpg" alt="" style="height:90px;"></a>
						</td>
						<td class="cart-name">
							<h4><a href=""><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</a></h4>
						</td>
						<td class="cart-body">
							<form class="corpus">
								<?php if ($_smarty_tpl->tpl_vars['val']->value['corpusMaterial']) {?>
									<a class="btn btn-default add-material" id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
|0" style="border-radius:10px;text-align:center;outline:none;margin-bottom:5px;">Изменить материал</a>
									<p class="p-material-added">Материал: <b><?php echo $_smarty_tpl->tpl_vars['val']->value['corpusMaterial'];?>
</b></p>
								<?php } else { ?>
									<a class="btn btn-default add-material"  id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
|0" style="border-radius:10px;text-align:center;outline:none;margin-bottom:10px;">Добавить материал</a>
								<?php }?>
							</form>
							<form class="color-button-corpus" style="display:flex;">
								Цвет:
								<input type="hidden" style="width:100px;" class="color" name="color" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['corpusColor'];?>
"/>
								<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"/>
							</form>
							
						</td>
						<?php if ($_smarty_tpl->tpl_vars['val']->value['facade']) {?>
							<td class="cart-facade">
								<form class="facade" action="/materials" method="get">
										<?php if ($_smarty_tpl->tpl_vars['val']->value['facadeMaterial']) {?>
											<a class="btn btn-default add-material" id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
|1" style="border-radius:10px;text-align:center;outline:none;margin-bottom:5px;">Изменить материал</a>
											<p class="p-material-added">Материал: <b><?php echo $_smarty_tpl->tpl_vars['val']->value['facadeMaterial'];?>
</b></p>
										<?php } else { ?>
											<a class="btn btn-default add-material"  id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
|1" style="border-radius:10px;text-align:center;outline:none;margin-bottom:10px;">Добавить материал</a>
										<?php }?>
								</form>
								<form class="color-button-facade" style="display:flex;">
									Цвет:
									<input type="hidden" style="width:100px;" class="color" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['facadeColor'];?>
"/>
									<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" />
								</form>	
								
							</td>
						<?php } else { ?>
							<td class="cart-facade">
									<p>Недоступно</p>
								</td>
						<?php }?>
						<td class="cart-total">
							<p class="cart_total_price">
							
							<?php echo $_smarty_tpl->tpl_vars['val']->value['price'];?>

							</p>
						</td>
						<td class="cart-delete">
							<a class="cart_quantity_delete" id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><i class="fa fa-times" style="cursor:pointer;"></i></a>
						</td>
					</tr>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					
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
									<input type="text"id="address" value="" tabindex="1" style="border:0; border-radius:10px;text-align:center;outline:none;width: 100%;"/>
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
						<li>Итого: <span id="totalPrice"><?php echo $_smarty_tpl->tpl_vars['totalPrice']->value;?>
</span></li>
					</ul>
					<a class="btn btn-default update" id="cart-form">Заказать</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action--><?php }
}
