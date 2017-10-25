<?php
/**
 * @var PageConfig[] $allConfigs
 */
$allConfigs = $this->configs;

$actionsExceptions = array(
    "home/error"
);
$actionsExceptions = array_merge($actionsExceptions,$this->getControllerRoutes("user"));

$allActions = $this->getAllRoutes();
$sidebarActions = array_diff($allActions,$actionsExceptions);
?>

<div class="sidebar col-sm-2">
    <nav class="navbar navbar-default">
        <ul class="nav sidebar-nav">
            <?php foreach ($sidebarActions as $route){ ?>
                <li class="col-sm-12">
                    <a href="<?= $this->getLink($route); ?>" ><?= $allConfigs[$route]->getTitle(); ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <?php foreach ($sidebarActions as $route){ ?>
                <li>
                    <a href="<?= $this->getLink($route); ?>"><i class=""></i><?= $allConfigs[$route]->getTitle(); ?></a>
                </li>
            <?php } ?>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>