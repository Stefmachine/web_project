<?php ob_start();
$error = XPost("errorMessage");
?>
Une erreur est survenue. <?= $error; ?>
<?php $content = ob_get_clean();