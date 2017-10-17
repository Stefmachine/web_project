<?php
session_start();
include_once "route.php";
require_once "UserController.php";

if(XPost("username") && XPost("password")){
    UserController::login(XPost("username"),XPost("password"));
}

$pageRequest = XGet("page");
if(!empty($pageRequest)) {
    if(pageNeedsConnection($pageRequest) && empty($_SESSION["connectedUser"])){
        $theLink = getLink("login");
    }
    else{
        $theLink = getLink($pageRequest);

    }
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