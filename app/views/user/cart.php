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
                        <a data-toggle="collapse" onclick="toggleArrow()" href="#collapse<?= $orderNum; ?>">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Commande #<?= $order->getId(); ?>
                                    <?= (!empty($order->getCompletedTime()) ? $order->getCompletedTime() : "" ); ?>
                                <div class="text-right"><i id="arrow" class="glyphicon glyphicon-menu-down"></i></div>
                                </h4>
                            </div>

                        </a>
                        <div id="collapse<?= $orderNum; ?>" class="panel-collapse collapse">
                            <table id="cart-table" class="table table-striped table-hover text-center">
                                <thead class="text-left">
                                <tr>
                                    <th>Nom</th>
                                    <th>Image</th>
                                    <th>Portion</th>
                                    <th>Quantité</th>
                                    <th>Coût</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <?php
                                /**
                                 * Order lines were added in controller
                                 * @type OrderProduct $orderLine
                                 */
                                foreach ($order->lines as $lineNum => $orderLine) {
                                    /**
                                     * Product was added in controller
                                     * @type Product $product
                                     */
                                    $product = $orderLine->product;?>

                                    <tr id="rowProduct<?= $product->getId() ?>">
                                        <td><?= $product->getName() ?></td>
                                        <td><img width="100px" src="<?= resource("img/products/" . $product->getPicture()) ?>" alt="<?= $product->getName() ?> image"></td>
                                        <td>
                                            <select onchange="updateAttributes(<?= $product->getId(); ?>)" class="form-control size" name="size" id="size">
                                                <option <?= ($orderLine->getSize() == "kid")? "selected=selected" : "" ?> value="kid">Enfant</option>
                                                <option <?= ($orderLine->getSize() == "small")? "selected=selected" : "" ?> value="small">Petit</option>
                                                <option <?= ($orderLine->getSize() == "regular")? "selected=selected" : "" ?> value="regular">Régulier</option>
                                            </select>
                                        </td>
                                        <td><input onchange="updateAttributes(<?= $product->getId(); ?>)" class="form-control quantity" type="text" value="<?= $orderLine->getQuantity() ?>"></td>
                                        <td id="cost<?= $product->getId() ?>"><?= number_format($orderLine->getCost(),2); ?>$</td>
                                        <td><a class="btn btn-danger glyphicon glyphicon-remove" onclick="removeFromCart(<?= $product->getId() ?>)"></a></td>
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