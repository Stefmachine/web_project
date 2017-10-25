<?php
/**
 * @var PageConfig[] $allConfigs
 */
$allConfigs = $_data["configs"];
$actionsExceptions = array();
if(1){ //TODO:if user is not connected
    $actionsExceptions = array(
        "user/logout",
        "user/profile",
    );
}
else{
    $actionsExceptions = array(
        "user/login"
    );
}

$allUserActions = $this->getControllerRoutes("user");
$menuActions = array_diff($allUserActions,$actionsExceptions);
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
    <?php foreach ($menuActions as $route){ ?>
        <li>
            <a title="<?= $allConfigs[$route]->getTitle(); ?>" href="<?= $this->getLink($route); ?>">
                <i class="<?= $allConfigs[$route]->getGlyphiconClass(); ?>"></i>
            </a>
        </li>
    <?php } ?>
</ul>
<!-- /.navbar-top-links -->