<?php

function makeProduct($title, $price, $id, $img) {
	$var = 
	'
	<div class="col-sm-4 text-center product">
		<a href="/controller/pageLoader.php?page=product_' . $id . '">
			<img class="thumbnail" src="' . $img . '"/>
			<h2>' . $title . '</h2>
			<h3>' . $price . '</h3>
		</a>
	</div>
	';
	
	return $var;
}

?>