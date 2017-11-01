<div class="container-fluid grid">
    <div class="row container-fluid">
        <?= makeProduct('Burrito', '19.99$', '001', 'http://food.fnr.sndimg.com/content/dam/images/food/fullset/2013/2/14/0/FNK_breakfast-burrito_s4x3.jpg.rend.hgtvcom.616.462.suffix/1382542427230.jpeg') ?>
        <?= makeProduct('Taco', '9.99$', '002', 'https://assets.bonappetit.com/photos/57adf80c1b33404414975841/16:9/w_1000,c_limit/sloppy-tacos.jpg') ?>
        <?= makeProduct('Quesadilla', '0.99$', '003', 'http://www.simplyrecipes.com/wp-content/uploads/2006/05/quesadilla-hoirz-640.jpg') ?>
    </div>
</div>
<?php

function makeProduct($title, $price, $id, $img) {
    $var =
        '
	<div class="col-sm-4 text-center product">
		<a href="/public/shop/product/' .$id . '">
			<img class="thumbnail" src="' . $img . '"/>
			<h2>' . $title . '</h2>
			<h3>' . $price . '</h3>
		</a>
	</div>
	';
    return $var;
}

?>