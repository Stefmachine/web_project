<?php
session_start();
require_once "route.php";
require_once "controllerLoader.php";

// Generate product code to include in Grid
require_once "../views/templates/product.php";

if(XPost("username") && XPost("password")){
    UserController::login(XPost("username"),XPost("password"));
}

if(XGet("logout")){
    UserController::logout();
}

$pageRequest = XGet("page");
if(!empty($pageRequest)) {
    if(pageNeedsConnection($pageRequest) && empty($_SESSION["connectedUser"])){
        $theLink = getFile("login");
    }
    else{
        try {
            $theLink = getFile($pageRequest);
        }
        catch (Exception $e){
            generateErrorPost($e);
        }
    }
    buildPage($theLink);
}
else{
    header("location: ../index.php");
}

/**
 * @param string $_key
 * @return string
 */
function XGet($_key){
    return isset($_GET[$_key]) ? htmlentities($_GET[$_key]) : "" ;
}

/**
 * @param string $_key
 * @return string
 */
function XPost($_key){
    return isset($_POST[$_key]) ? htmlentities($_POST[$_key]) : "" ;
}

function XSession($_key){
    return isset($_SESSION[$_key]) ? htmlentities($_SESSION[$_key]) : "" ;
}

function removeXSession($_key){
    if(isset($_SESSION[$_key])){
        unset($_SESSION[$_key]);
        return true;
    }
    return false;
}

function setXSession($_key,$_value){
    $_SESSION[$_key] = htmlentities($_value);
}

function pageFromRequestURI(){
    $uri = $_SERVER["REQUEST_URI"];
    $needle = "page=";
    $page = substr($uri,strpos($uri,$needle)+strlen($needle));
    return $page;
}

/**
 * @param Exception $_exception
 */
function generateErrorPost($_exception){
    ?>
    <form id="errorForm" action="pageLoader.php?page=error" method="post">
        <input type="hidden" name="errorMessage" value="<?= $_exception->getMessage() ?>">
    </form>
    <script type="text/javascript">
        document.getElementById('errorForm').submit();
    </script>
    <?php
}