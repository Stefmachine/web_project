<?php
/**
 * @type Product $product
 */
$product = $_data["product"]; ?>
<div><?= $product->getId(),$product->getName(),$product->getCost() ?></div>