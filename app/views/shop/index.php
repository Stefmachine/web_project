<?php
$pageCount = $_data["pagesCount"];
$productCount = count($_data["products"]); ?>
<div class="menu">
    <div class="container">
        <?php if ($productCount) { ?>
            <div class="menu-top">
                <div class="col-md-5 menu-left animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <h3>Menu<?= !empty($_data["tag"]) ? " des " . ucfirst($_data["tag"]) . "s" : "" ?></h3>
                    <label><i class="glyphicon glyphicon-menu-up"></i></label>
                    <span>Jusqu'à <?= $productCount ?> repas</span>
                </div>
                <div class="col-md-7 menu-right animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <p>Nos menus variés sont connus à travers le monde. Nos plats sont originaires du Mexique, sont composés d'ingrédients cultivés en Chine, cuisinés au Viet-Nam et vendus en Amérique du Nord</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
            /**
             * @type Product $product
             */
			
            foreach ($_data["products"] as $key => $product) {
                if (!boolval($key % 3)){ ?>
                    <div class="menu-bottom animated wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
                <?php } ?>
                <div class="col-md-4 menu-bottom1">
                    <div class="btm-right">
                        <a href="<?= GlobalHelper::pageLink("shop/product/{$product->getId()}") ?>">
                            <img src="<?= resource('img/products/' . $product->getPicture()) ?>" alt="" class="img-responsive">
                            <div class="captn">
                                <h4><?= $product->getName() ?></h4>
                                <p><?= $product->getCost() ?>$</p>
                                <p id="addToCart<?= $product->getId() ?>" <?= (in_array($product->getId(),$_data["onOrder"]) ? "style='display:none'" : "" ); ?> class="btn fitIn" onclick="addToCart(<?= $product->getId(); ?>); return false;">Ajouter au panier</p>
                                <p id="inCart<?= $product->getId() ?>" <?= (!in_array($product->getId(),$_data["onOrder"]) ? "style='display:none'" : "" ); ?> class="">Déjà dans le panier <i class="glyphicon glyphicon-shopping-cart"></i> </p>
                            </div>
                        </a>
                    </div>
                    <h3>
                        <div id="alert<?= $product->getId(); ?>" class="hidden customAlert alert" role="alert"></div>
                    </h3>
                </div>
                <?php if ((!boolval(($key + 1) % 3) && $key > 0) || $key + 1 == $productCount){ ?>
                    <div class="clearfix"></div>
                    </div>
                <?php } ?>
            <?php }
            if ($pageCount > 1) { ?>
                <div class="col-md-12 text-center pager">Pages
                    <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                        <a class="<?= ($_data["index"] == $i ? 'bold' : '') ?>" href="<?= GlobalHelper::pageLink("shop/index/{$i}/{$_data["tag"]}") ?>"> <?= $i ?> </a>
                    <?php } ?>
                </div>
            <?php }

        } else { ?>
            <div>Aucun produit n'a été trouvé</div>
        <?php } ?>
    </div>
</div>



