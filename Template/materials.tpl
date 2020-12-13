<section>
        <div class="container">
                <div class="qwerty">
                    <div class="features_items">
                        <h2 class="title text-center">Материалы</h2>

                        {foreach $materials as $val}

                        <div class="col-sm-3" id="material">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/Template/images/material/{$val.img}.jpg" alt="" />
                                            <h2>{$val.price}</h2>
                                            <p>{$val.name}</p>
                                            {if $BuyMaterials}
                                                	<a class="btn btn-default add-to-cart" id="{$val.id}"><i class="fa fa-shopping-cart"></i>Добавить к товару</a>
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

                    </div>
            </div>
            <ul class="pagination">
                {$pagination}
            </ul>
        </div>
    </section>