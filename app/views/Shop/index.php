<?php
$pageCount = $_data["pagesCount"];
$productCount = count($_data["products"]);
if($productCount){

    //Every products
    /**
     * @type Product $product
     */
	?>
	<div class="row">
	<?php
	
	// Grid Generator
	$columns=0;
	
	foreach ($_data["products"] as $product) { 
		$columns++; ?>
		<div class="col-md-4 text-center">
			<div class="row">
				<div class="col-md-8 col-sm-offset-2">
					<img class="img-thumbnail" src="<?= resource('img/products/' . $product->getPicture()) ?>"/>
				</div>
			</div>
			<div class="row">
				<a href="<?= GlobalHelper::pageLink("shop/product/{$product->getId()}") ?>"><h4><?= $product->getName() ?></h4></a>
			</div>
		</div>
		
		<?php
		if ($columns == 3)
		{?>
			
				</div>
				<div class="row">
			<?php
			$columns = 0;
		}
	}?>
	
	</div>
	
	
    <?php //End of every products

    //Pages numbers
    if($pageCount > 1){ ?>
        <div class="col-md-12 text-center pager">Pages
			<?php for ($i = 1; $i <= $pageCount; $i++){ ?>
				<a href="<?= GlobalHelper::pageLink("shop/index/{$i}/{$_data["tag"]}") ?>"> <b><?= $i ?> </b></a>
			<?php } ?>
        </div>
    <?php }
	//End of pages numbers
}
else { ?>
    <div>Aucun produit n'a été trouvé</div>
<?php } ?>



