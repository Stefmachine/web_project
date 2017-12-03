<div class="container s-40">
    <div>
        <h2>Commandes</h2>
    </div>
    <div class="row s-20">
        <div class="col-md-12">
            <h4>Toutes vos commandes passées, au cas où vous auriez oublié!</h4>
            <div class="panel-group s-20">
                <div class="alert alert-<?= $_data["completed"] ?> <?= !$_data["completed"] ? "hidden" : "" ?>"><?= $_data["message"] ?></div>
                <?php
                /**
                 * @type Order $order
                 */
                foreach ($_data["orders"] as $orderNum => $order) {
                    if(count($order->lines) > 0){ ?>
                        <div class="panel panel-default">
                            <div class="s-10 m-10 text-right <?= $order->getState() != "completed" ? "" : "hidden"; ?>">
                                <a id="commit" href="<?= GlobalHelper::pageLink("user/completeOrder") ?>" class="btn btn-primary"> Compléter la transaction </a>
                            </div>
                            <div class="s-10 m-10 text-right"><h3><?= (!empty($order->getCompletedTime()) ? date("d-m-Y H:i",$order->getCompletedTime()) : "" ); ?></h3></div>
                            <a data-toggle="collapse" onclick="toggleArrow()" href="#collapse<?= $orderNum; ?>">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        Commande #<?= $order->getId(); ?>
                                        <div class="text-right"><i id="arrow" class="glyphicon glyphicon-menu-down"></i></div>
                                    </div>
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
                                        <?php if($order->getState() != "completed"){ ?>
                                            <th>Actions</th>
                                        <?php } ?>
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
                                        $product = $orderLine->product;
                                        $choices = array("kid"=>"Enfant","small"=>"Petit","regular"=>"Régulier")
                                        ?>

                                        <tr id="rowProduct<?= $product->getId() ?>">
                                            <td><?= $product->getName() ?></td>
                                            <td><img class="bordered" width="100px" src="<?= resource("img/products/" . $product->getPicture()) ?>" alt="<?= $product->getName() ?> image"></td>
                                            <td>
                                                <?php if($order->getState() != "completed"){ ?>
                                                    <select onchange="updateAttributes(<?= $product->getId(); ?>)" class="form-control size" name="size" id="size">
                                                        <option <?= ($orderLine->getSize() == "kid")? "selected=selected" : "" ?> value="kid">Enfant</option>
                                                        <option <?= ($orderLine->getSize() == "small")? "selected=selected" : "" ?> value="small">Petit</option>
                                                        <option <?= ($orderLine->getSize() == "regular")? "selected=selected" : "" ?> value="regular">Régulier</option>
                                                    </select>
                                                <?php } else {
                                                    echo (!empty($choices[$orderLine->getSize()]) ? $choices[$orderLine->getSize()] : "Inconnue" );
                                                } ?>
                                            </td>
                                            <td>
                                                <?php if($order->getState() != "completed"){ ?>
                                                    <input onchange="updateAttributes(<?= $product->getId(); ?>)" class="form-control quantity" type="text" value="<?= $orderLine->getQuantity() ?>">
                                                <?php } else {
                                                    echo $orderLine->getQuantity();
                                                } ?>
                                            </td>
                                            <td id="cost<?= $product->getId() ?>"><?= number_format($orderLine->getCost(),2); ?>$</td>
                                            <?php if($order->getState() != "completed"){ ?>
                                                <td><a class="btn btn-danger glyphicon glyphicon-remove" onclick="removeFromCart(<?= $product->getId() ?>)"></a></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>