<?php
/**
 * @type Product $product
 */
$product = $_data["product"]; ?>

<div class="container">
	<div class="col-md-9">
		<div class="row s-40">
			<div class="col-md-1">
				<h3 class=red><?= $product->getCost() ?>$</h3>
			</div>
			<div class="col-md-11">
				<h3><?= $product->getName() ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<img class="thumbnail" src="<?= resource('img/products/' . $product->getPicture()) ?>"/>
			</div>
			<div class="col-md-6">
				<h4>
					<?= $product->getDescription() ?>
				</h4>
			</div>
		</div>
		
	</div>
	<div class="col-md-3 s-40">
		<div class="col-md-8">
			<form>
				<div class="row">
					<div class="form-group col-md-6">
						<input type="number" class="form-control" id="quantitee" placeholder="Quantity" value=1>
					</div>
					
				</div>
				<div class="row">
					<a type="submit" class="btn cart-button col-md-6">
						<i class="glyphicon glyphicon-shopping-cart"></i> <h4>Add to Cart</h4>
					</a>
                </div>
			</form>
		</div>
	</div>
</div>