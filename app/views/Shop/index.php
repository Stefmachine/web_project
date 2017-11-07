<?php
$pageCount = $_data["pagesCount"];
$productCount = count($_data["products"]);
if($productCount){

    //Every products
    /**
     * @type Product $product
     */
    foreach ($_data["products"] as $product){ ?>
        <div>
            <a href="<?= GlobalHelper::pageLink("shop/product/{$product->getId()}") ?>"><?= $product->getName() ?></a>
        </div>
    <?php }
    //End of every products

    //Pages numbers
    if($pageCount > 1){ ?>
            <div>Pages
        <?php for ($i = 1; $i <= $pageCount; $i++){ ?>
            <a href="<?= GlobalHelper::pageLink("shop/index/{$i}/{$_data["tag"]}") ?>"> <?= $i ?> </a>
        <?php } ?>
            </div>
    <?php }
    //End of pages numbers

}
else { ?>
    <div>Aucun produit n'a été trouvé</div>
<?php } ?>



