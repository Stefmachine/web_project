<?php
$pageExceptions = array("error");
if(empty($_SESSION["connectedUser"])){
    $pageExceptions[] = "logout";
}
else{
    $pageExceptions[] = "login";
}
?>
<header>
    <h2><?= getPageTitle(XGet("page")) ?></h2>
    <nav>
        <ul>
            <?php foreach (getAllLinks() as $pageName => $attributes) {
                if(!in_array($pageName,$pageExceptions)) {
                    ?><li><a href="<?= "/controller/pageLoader.php?page=$pageName" ?>"><?= isset($attributes["title"])? $attributes["title"] : "Page inconnue" ?></a></li><?php
                }
            } ?>
        </ul>
    </nav>
</header>