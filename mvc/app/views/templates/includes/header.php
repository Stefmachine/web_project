<?php
/**
 * @var PageConfig[] $allConfigs
 */
$allConfigs = $_data["configs"];
?>
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?= $this->getLink("home/index"); ?>">OOZE</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <?php if(1){ //todo:user is not connected ?>
    <li>
        <a title="<?= $allConfigs["user/login"]->getTitle(); ?>" href="<?= $this->getLink("user/login"); ?>">
            <i class="glyphicon glyphicon-log-in"></i>
        </a>
    </li>
    <?php } else { ?>
    <li>
        <a title="<?= $allConfigs["user/logout"]->getTitle(); ?>" href="<?= $this->getLink("user/logout"); ?>">
            <i class="glyphicon glyphicon-log-out"></i>
        </a>
    </li>
    <li>
        <a title="<?= $allConfigs["user/profile"]->getTitle(); ?>" href="<?= $this->getLink("user/profile"); ?>">
            <i class="glyphicon glyphicon-user"></i>
        </a>
    </li>
    <?php } ?>
    <li>
        <a title="<?= $allConfigs["user/cart"]->getTitle(); ?>" href="<?= $this->getLink("user/cart"); ?>">
            <i class="glyphicon glyphicon-shopping-cart"></i>
        </a>
    </li>
</ul>
<!-- /.navbar-top-links -->