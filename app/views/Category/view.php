<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <?= $breadcrumbs ?>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->

<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-9 prdt-left">
                <?php if (!empty($products)): ?>
                    <?php $curr = \ishop\App::$app->getProperty("currency");?>

                    <div class="product-one">
                        <?php foreach( $products as $product): ?>
                            <div class="col-md-4 product-left p-left">
                                <div class="product-main simpleCart_shelfItem">
                                    <a href="product/<?= $product->alias ?>" class="mask"><img class="img-responsive zoom-img" src="images/<?= $product->img ?>" alt="" /></a>
                                    <div class="product-bottom">
                                        <h3> <?= $product->title ?> </h3>
                                        <p>Explore Now</p>
                                        <h4>
                                            <a class="add-to-cart-link" data-id="<?= $product->id ?>" href="cart/add?id=<?= $product->id ?>"><i></i></a>
                                            <span class=" item_price">
                                            <?= $curr['symbol_left'] ?>
                                            <?= $product->price * $curr['value'] ?>
                                            <?= $curr['symbol_right'] ?>
                                        </span>
                                        </h4>
                                    </div>
                                    <div class="srch srch1">
                                        <span>-50%</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="clearfix"></div>

                        <div class="text-center">
                            <p> (<?= count($products) ?> товара(ов) из <?= $total ?>) </p>
                            <?php if ($pagination->countPages > 1): ?>
                                <?= $pagination ?>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php else: ?>
                    <h2> В этой категории товаров пока нет </h2>
                <?php endif; ?>
            </div>

            <div class="col-md-3 prdt-right">
                <div class="w_sidebar">
                    <?php new \app\widgets\filter\Filter(); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--product-end--