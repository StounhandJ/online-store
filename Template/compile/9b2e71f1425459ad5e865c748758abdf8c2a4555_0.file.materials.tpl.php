<?php
/* Smarty version 3.1.36, created on 2020-12-13 19:17:19
  from '/home/c/cn61693/public_html/Template/materials.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd63e8fc94eb6_99414098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b2e71f1425459ad5e865c748758abdf8c2a4555' => 
    array (
      0 => '/home/c/cn61693/public_html/Template/materials.tpl',
      1 => 1607876195,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd63e8fc94eb6_99414098 (Smarty_Internal_Template $_smarty_tpl) {
?><section>
        <div class="container">
                <div class="qwerty">
                    <div class="features_items">
                        <h2 class="title text-center">Материалы</h2>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['materials']->value, 'val');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>

                        <div class="col-sm-3" id="material">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/Template/images/material/<?php echo $_smarty_tpl->tpl_vars['val']->value['img'];?>
.jpg" alt="" />
                                            <h2><?php echo $_smarty_tpl->tpl_vars['val']->value['price'];?>
</h2>
                                            <p><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</p>
                                            <?php if ($_smarty_tpl->tpl_vars['BuyMaterials']->value) {?>
                                                	<a class="btn btn-default add-to-cart" id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><i class="fa fa-shopping-cart"></i>Добавить к товару</a>
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

                    </div>
            </div>
            <ul class="pagination">
                <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

            </ul>
        </div>
    </section><?php }
}
