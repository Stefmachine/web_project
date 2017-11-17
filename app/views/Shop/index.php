<?php
$pageCount = $_data["pagesCount"];
$productCount = count($_data["products"]); ?>
<div class="menu">
    <div class="container">
        <?php if ($productCount) { ?>
            <div class="menu-top">
                <div class="col-md-5 menu-left animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <h3>Menu des <?= ucfirst($_data["tag"]) ?>s</h3>
                    <label><i class="glyphicon glyphicon-menu-up"></i></label>
                    <span>Jusqu'à <?= $productCount ?> repas</span>
                </div>
                <div class="col-md-7 menu-right animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                        alteration in some form, by injected humour , or randomised words which don't look even slightly
                        believable.There are many variations by injected humour. There are many variations of passages of
                        Lorem Ipsum available.There are many variations of passages of Lorem Ipsum available, but the
                        majority have suffered alteration in some form by injected humour , or randomised words</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
            /**
             * @type Product $product
             */
            foreach ($_data["products"] as $key => $product) {
                if ($key % 3 == 0){ ?>
                    <div class="menu-bottom animated wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
                <?php } ?>
                <div class="col-md-4 menu-bottom1">
                    <div class="btm-right">
                        <a href="<?= GlobalHelper::pageLink("shop/product/{$product->getId()}") ?>">
                            <img src="<?= resource('img/products/' . $product->getPicture()) ?>" alt="" class="img-responsive">
                            <div class="captn">
                                <h4><?= $product->getName() ?></h4>
                                <p><?= $product->getCost() ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php if (($key % 3 == 0 && $key > 0) || $key+1 == $productCount){ ?>
                    <div class="clearfix"></div>
                    </div>
                <?php } ?>
            <?php } ?>

            <?php
            if ($pageCount > 1) { ?>
                <div class="col-md-12 text-center pager">Pages
                    <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                        <a href="<?= GlobalHelper::pageLink("shop/index/{$i}/{$_data["tag"]}") ?>"> <b><?= $i ?> </b></a>
                    <?php } ?>
                </div>
            <?php }

        } else { ?>
            <div>Aucun produit n'a été trouvé</div>
        <?php } ?>
    </div>
</div>



