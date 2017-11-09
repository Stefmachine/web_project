<?php
$allConfigs = $_data["configs"];

?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav nav-first-level" id="side-menu">
            <li>
                <a href="<?= GlobalHelper::pageLink("home/index"); ?>">
                    <i class=""></i><?= $allConfigs["home/index"]["title"]; ?>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class=""></i><?= $allConfigs["shop/index"]["title"]; ?>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= GlobalHelper::pageLink("shop/index"); ?>">
                            <i class=""></i>Voir tous
                        </a>
                    </li>
                    <li>
                        <a href="<?= GlobalHelper::pageLink("shop/index/1/taco"); ?>">
                            <i class=""></i>Tacos
                        </a>
                    </li>
                    <li><a href="<?= GlobalHelper::pageLink("shop/index/1/tortilla"); ?>">
                            <i class=""></i>Tortillas
                        </a>
                    </li>
                    <li>
                        <a href="<?= GlobalHelper::pageLink("shop/index/1/quesadilla"); ?>">
                            <i class=""></i>Quesadillas
                        </a>
                    </li>
                    <li>
                        <a href="<?= GlobalHelper::pageLink("shop/index/1/enchilada"); ?>">
                            <i class=""></i>Enchilada
                        </a>
                    </li>
                    <li>
                        <a href="<?= GlobalHelper::pageLink("shop/index/1/burrito"); ?>">
                            <i class=""></i>Burritos
                        </a>
                    </li>
                    <li>
                        <a href="<?= GlobalHelper::pageLink("shop/index/1/chimichanga"); ?>">
                            <i class=""></i>Chimichangas
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= GlobalHelper::pageLink("home/contact"); ?>">
                    <i class=""></i><?= $allConfigs["home/contact"]["title"]; ?>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>