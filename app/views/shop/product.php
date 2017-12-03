<?php
/**
 * @type Product $product
 */
$product = $_data["product"]; ?>

<div class="blog">
    <div class="container">

        <div class="col-md-7 ">
            <div class="single">

                <div class="single-top">
                    <div class="lone-line s-15">
                        <h4><?= $product->getName() ?></h4>
                    </div>
                    <img class="img-responsive wow fadeInUp animated bordered" data-wow-delay=".5s" src="<?= resource("img/products/{$product->getPicture()}"); ?>" alt="" />
                </div>
            </div>
        </div>
        <div class="col-md-5 categories-grid s-40">
            <div class="grid-categories animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h4>Description</h4>
                <p><?= $product->getDescription(); ?></p>
            </div>
            <div class="search-in animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h4>Ajouter au panier</h4>
                <div class="s-15">
                    <h3>Enfant: <?= number_format($product->getCost() * 0.75,2); ?>$</h3>
                    <h3>Petit: <?= number_format($product->getCost(),2); ?>$</h3>
                    <h3>Régulier: <?= number_format($product->getCost() * 1.5,2); ?>$</h3>
                </div>
                <div>
                    <form role="form"  id="addToCartForm" action="index.php?url=user/addToCart">
                        <input type="hidden" id="productId" value="<?= $product->getId(); ?>">
                        <div class="form-group">
                            <label for="size">Format</label>
                            <select class="form-control" name="size" id="size">
                                <option value="kid">Enfant</option>
                                <option value="small">Petit</option>
                                <option value="regular">Régulier</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantité</label>
                            <input id="quantity" name="quantity" class="form-control" type="text" value="1">
                        </div>
                        <div id="addToCart" class="form-group" style="<?= ($_data['inOrder'] ? "display:none;" : "" ) ?>" >
                            <button type="submit" class="btn btn-fitIn">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                Ajouter au panier
                            </button>
                        </div>
                        <div id="inCart" class="alert alert-info" style="<?= ($_data['inOrder'] ? "" : "display:none;" ) ?>" >
                            Dans le panier   <i class="glyphicon glyphicon-shopping-cart"></i>
                        </div>
                        <div id="alertDiv"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>