<?php
$title = (isset($title)? $title : "UnknownPage");
?>
<header>
    <h2><?= $title ?></h2>
    <nav>
        <ul>
            <?php foreach (getAllLinks() as $pageName => $attributes) {
                ?><li><a href="<?="/controller/pageLoader.php?page=$pageName"?>"><?= ucwords($pageName) ?></a></li><?php
            } ?>
        </ul>
    </nav>
</header>