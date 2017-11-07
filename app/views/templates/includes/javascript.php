<?php
if(isset($viewParts)){
    $script = "{$viewParts[0]}.{$viewParts[1]}.js"; ?>
    <script type="text/javascript" src="<?= resource("js/$script"); ?>"></script>
<?php } ?>