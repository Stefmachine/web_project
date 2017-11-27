<div class="container s-40">
    <div>
        <h2>Commandes</h2>
    </div>
    <div class="row s-20">
        <div class="col-md-10">
            <h4>Toutes vos commandes passées, au cas où vous auriez oublié!</h4>
            <div class="panel-group s-20">
                <?php
                /**
                 * @type Order $order
                 */
                foreach ($_data["orders"] as $orderNum => $order) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse<?= $orderNum; ?>">Order #<?= $order->getId(); ?></a>
                            </h4>
                        </div>
                        <div id="collapse<?= $orderNum; ?>" class="panel-collapse collapse">
                            <table class="table table-striped text-center">
                                <thead class="text-left">
                                <tr>
                                    <td>Nom</td>
                                    <td>Image</td>
                                    <td>Portion</td>
                                    <td>Quantité</td>
                                    <td>Coût</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <?php
                                /**
                                 * Order line was added in controller
                                 * @type OrderProduct $orderLine
                                 */
                                foreach ($order->lines as $lineNum => $orderLine) {
                                    /**
                                     * @type Product $product
                                     */
                                    $product = $orderLine->product;?>

                                    <tr>
                                        <td><?= $product->getName() ?></td>
                                        <td><img width="100px" src="<?= resource("img/products/" . $product->getPicture()) ?>" alt="<?= $product->getName() ?> image"></td>
                                        <td><?= $orderLine->getSize() ?></td>
                                        <td><?= $orderLine->getQuantity() ?></td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </table>
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