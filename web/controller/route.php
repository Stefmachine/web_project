<?php
function getIncludeFile($_fileName){
    include __DIR__."/../views/templates/includes/$_fileName.php";
}

/**
 * @return array
 */
function getAllLinks(){
    $list = array(
        "home" => array("file" => "home.php", "needConnection" => false),
        "shop" => array("file" => "", "needConnection" => false),
        "contact_us" => array("file" => "", "needConnection" => false),
        "login" => array("file" => "login.php", "needConnection" => false),
        "profile" => array("file" => "", "needConnection" => true),
        "cart" => array("file" => "", "needConnection" => true)
    );
    return $list;
}

/**
 * @param string $_key
 * @return array
 * @throws Exception
 */
function getLink($_key){

    $navigation = getAllLinks();

    if(!isset($navigation[$_key])){
        throw new Exception("The item you requested ($_key) is not defined.");
    }

    return $navigation[$_key]["file"];
}

/**
 * @param string $_page
 * @return bool
 */
function pageNeedsConnection($_page){
    return isset(getAllLinks()[$_page])? getAllLinks()[$_page]["needConnection"] : false;
}

function buildPage($_link, $_template = "default.php"){
    $page = __DIR__."/../views/pages/$_link";
    $template = __DIR__."/../views/templates/$_template";

    include $page;
    include $template;
}