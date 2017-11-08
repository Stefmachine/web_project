<?php
/**
 * @type Product $product
 */
$product = $_data["product"]; ?>

<div class="row">
	<div class="col-md-9">
		<div class="row">
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
		</div>
		
		<h4>
			<?= $product->getDescription() ?>
		</h4>
		
	</div>
	<div class="col-md-3">
		<form>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="numeric" class="form-control" id="quantitee" placeholder="Quantity" value=1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<a type="submit" class="btn btn-primary">
						<i class="glyphicon glyphicon-shopping-cart"></i> <h4>Add to Cart</h4>
					</a>
				</div>
			</div>
		</form>
	</div>
</div>