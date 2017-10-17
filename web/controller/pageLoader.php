<?php
session_start();
include_once "route.php";

$pageRequest = XGet("page");
if(!empty($pageRequest)) {
    $theLink = getLink($pageRequest);
    buildPage($theLink);
}
else{
    header("location: ../index.php");
}

function XGet($_key){
    return isset($_GET[$_key]) ? htmlentities($_GET[$_key]) : "" ;
}

function XPost($_key){
    return isset($_POST[$_key]) ? htmlentities($_POST[$_key]) : "" ;
}?>