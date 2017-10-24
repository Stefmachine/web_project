<?php $pageExceptions = array("error");?>

<div class="sidebar">
	<ul>
		<?php
		foreach (getAllLinks() as $pageName => $attributes) {
			if(!in_array($pageName,$pageExceptions)) {
				if ($pageName != "login" && $pageName != "cart" && $pageName != "profile" && $pageName != "logout" ) {
					?><li><a href="<?= "/controller/pageLoader.php?page=$pageName" ?>"><?= isset($attributes["title"])? $attributes["title"] : "Page inconnue" ?></a></li><?php
				}
			}
		} ?>
	</ul>
</div>