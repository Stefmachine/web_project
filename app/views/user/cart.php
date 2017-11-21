<div class="container s-40">
	<div>
		<h2>Commandes</h2>
	</div>
	<div class="row s-20">
		<div class="col-md-10">
			<h4>Toutes vos commandes passées, au cas où vous auriez oublié!</h4>
			<div class="panel-group s-20">
				<?php
					foreach ($_data["order"] as $key => $order) { ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse<?= $key; ?>">Order ID: <?= $order->getId(); ?></a>
								</h4>
							</div>
							<div id="collapse<?= $key; ?>" class="panel-collapse collapse">
								<div class="panel-body">
									<?php
										foreach ($order->getOrderProducts() as $subkey => $orderProduct) {
											$product = $orderProduct->getProductId();
											echo '(' . $product->getId() . ') ' . $product->getName();
										} ?>
								</div>
								<!--<div class="panel-footer">Panel Footer</div>-->
							</div>
						</div>
				<?php } ?>
			</div>			
		</div>
		<div class="col-md-2">
			Some annoying ad
		</div>
	</div>
</div>