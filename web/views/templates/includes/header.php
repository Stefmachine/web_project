<?php
$title = (isset($title)? $title : "UnknownPage");
?>
<header>
    <h2><?= $title ?></h2>
    <nav>
        <ul>
            <?php foreach (getAllLinks() as $pageName => $link) {
                ?><li><a href="<?= $link ?>"><?= ucwords($pageName) ?></a></li><?php
            } ?>
        </ul>
    </nav>
</header>