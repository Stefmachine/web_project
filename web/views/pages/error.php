<?php ob_start();
$error = XPost("errorMessage");?>

<div class="text-center">
	<i class="glyphicon big-icon red glyphicon-remove-sign"></i>

	<div>
		<h2>Une erreur est survenue.</h2>
		</br>
		Erreur: <?= $error; ?>
		</br>
		</br>
	</div>
</div>
<?php $content = ob_get_clean();