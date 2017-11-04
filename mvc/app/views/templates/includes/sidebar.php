<?php
/**
 * @var PageConfig[] $allConfigs
 */
$allConfigs = $this->configs;

?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?= GlobalHelper::pageLink("home/index"); ?>">
                    <i class=""></i><?= $allConfigs["home/index"]->getTitle(); ?>
                </a>
            </li>
            <li>
                <a href="<?= GlobalHelper::pageLink("home/contact"); ?>">
                    <i class=""></i><?= $allConfigs["home/contact"]->getTitle(); ?>
                </a>
            </li>
            <li>
                <a href="<?= GlobalHelper::pageLink("shop/index"); ?>">
                    <i class=""></i><?= $allConfigs["shop/index"]->getTitle(); ?>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>