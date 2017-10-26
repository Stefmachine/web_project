<?php
require_once __DIR__."/../../core/AnnotationReader.php";

require_once __DIR__."/../../controllers/UserController.php";
$ar = new AnnotationReader();
var_dump($ar->GetClassAnnotations("UserController"));
var_dump($ar->getMethodAnnotations("UserController","profileAction"));