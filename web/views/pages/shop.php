<?php ob_start(); ?>
    Welcome to the shop page
	
	<div class="container-fluid grid">
		<div class="row container-fluid">
			<?= makeProduct('Burrito', '19.99$', '001', 'http://food.fnr.sndimg.com/content/dam/images/food/fullset/2013/2/14/0/FNK_breakfast-burrito_s4x3.jpg.rend.hgtvcom.616.462.suffix/1382542427230.jpeg') ?>
			<?= makeProduct('Taco', '9.99$', '002', 'https://assets.bonappetit.com/photos/57adf80c1b33404414975841/16:9/w_1000,c_limit/sloppy-tacos.jpg') ?>
			<?= makeProduct('Quesadilla', '0.99$', '003', 'http://www.simplyrecipes.com/wp-content/uploads/2006/05/quesadilla-hoirz-640.jpg') ?>
		</div>
	</div>
	
<?php $content = ob_get_clean();