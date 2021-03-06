<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<section id="advertisement">
    <div class="container">
        <img src="/images/shop/advertisement.jpg" alt=""/>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?=
                        \app\components\MenuWidget::widget(['tpl' => 'menu'])
                        ?>
                    </ul>
                </div><!--/brands_products-->

                <div class="price-range"><!--price-range-->
                    <h2>Price Range</h2>
                    <div class="well">
                        <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                               data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br/>
                        <b>$ 0</b> <b class="pull-right">$ 600</b>
                    </div>
                </div><!--/price-range-->

                <div class="shipping text-center"><!--shipping-->
                    <img src="/images/home/shipping.jpg" alt=""/>
                </div>
            </div><!--/shipping-->
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Поиск по запросу <?= Html::encode($q) ?></h2>
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $product)  : ?>
                            <?php $img = $product->getImage();?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("{$img->getUrl()}", ['alt' => $product->name]); ?><!--                                        <img src="images/home/product1.jpg" alt=""/>-->
                                            <h2>$<?= $product->price ?></h2>
                                            <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"><?= $product->name ?></a></p>
                                            <a href="#" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <!--                                    <div class="product-overlay">-->
                                        <!--                                        <div class="overlay-content">-->
                                        <!--                                            <h2>$56</h2>-->
                                        <!--                                            <p>Easy Polo Black Edition</p>-->
                                        <!--                                            <a href="#" class="btn btn-default add-to-cart"><i-->
                                        <!--                                                        class="fa fa-shopping-cart"></i>Add to cart</a>-->
                                        <!--                                        </div>-->
                                        <!--                                    </div>-->
                                        <?php if ($product->new) : ?>
                                            <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => 'new']); ?>
                                        <?php endif; ?>
                                        <?php if ($product->sale) : ?>
                                            <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']); ?>
                                        <?php endif; ?>
                                        <!--                                    <img src="images/home/new.png" class="new" alt="">-->
                                    </div>
                                    <!--                                <div class="choose">-->
                                    <!--                                    <ul class="nav nav-pills nav-justified">-->
                                    <!--                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>-->
                                    <!--                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>-->
                                    <!--                                    </ul>-->
                                    <!--                                </div>-->
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                        <?php echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                        ]); ?>
                    <?php else : ?>
                        <h2>Ничего не найдено</h2>
                    <?php endif; ?>
                </div>
            </div>


            <!--                    <ul class="pagination">-->
            <!--                        <li class="active"><a href="">1</a></li>-->
            <!--                        <li><a href="">2</a></li>-->
            <!--                        <li><a href="">3</a></li>-->
            <!--                        <li><a href="">&raquo;</a></li>-->
            <!--                    </ul>-->


        </div>
    </div>
    </div>
    </div>
</section>