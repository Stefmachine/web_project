<?php
foreach (glob("/*Controller.php") as $controllerFile) {
    require_once $controllerFile;
}